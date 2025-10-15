<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table; 
use Filament\Resources\Resource;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
   protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->unique(
                              table: 'posts',
                              column: 'title',
                              ignorable: fn ($record) => $record
                   )
                    ->validationMessages([
                            'unique' => 'Un article avec ce titre existe déjà.',
                         ])
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', \Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),
                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->relationship('category', 'name'),
               
                Select::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload() // ⚡ charge tous les tags dès l'ouverture
                    ->searchable(false) // désactive la recherche obligatoire
                    ->placeholder('Sélectionnez un ou plusieurs tags')
                    ->helperText('Choisissez les tags associés à cet article.'),

                Textarea::make('content')
                    ->required()
                    ->rows(10),
                DatePicker::make('published_at')
                    ->label('Publish Date'),
                FileUpload::make('image')
                ->image()
                ->directory('posts') // images seront stockées dans storage/app/public/posts
                ->maxSize(2048), // taille max 2MB
            ]);
    }

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('category.name')
                ->label('Catégorie'),

            Tables\Columns\IconColumn::make('is_published')
                ->boolean()
                ->label('Publié'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime('d/m/Y H:i'),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('is_published')
                ->label('Statut de publication'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
