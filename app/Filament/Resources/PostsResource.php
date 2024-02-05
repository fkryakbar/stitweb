<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Posts;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsResource extends Resource
{
    protected static ?int $navigationSort = 1;
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $recordTitleAttribute = 'title';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->live(debounce: 500)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Hidden::make('user_id')->default(auth()->user()->id)->required(),
                TextInput::make('slug')->unique(table: 'posts', ignoreRecord: true)->required()->visibleOn('edit')->readOnlyOn(['edit', 'create']),
                Select::make('category_id')->label('Category')
                    ->options(function () {
                        return Category::all()->pluck('name', 'id');
                    }),
                Textarea::make('description')->required(),
                FileUpload::make('image_path')->directory('thumbnail')->maxSize(1024)->label('Thumbnail'),
                RichEditor::make('content')->required()
            ])->columns(1);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('views')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable()->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Category')->relationship('category', 'name')->label('Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePosts::route('/'),
        ];
    }
}
