<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('sku')
                    ->label('SKU'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Toggle::make('is_visible')
                    ->required(),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->directory('products')
                    ->label('Fotografía del Mueble'),
                Forms\Components\TextInput::make('dimensions'),
            ]);
    }

 public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('image_url')
                        ->height('160px')
                        ->extraImgAttributes(['class' => 'object-cover rounded-xl w-full mb-3 shadow-sm']),
                    
                    TextColumn::make('name')
                        ->weight('bold')
                        ->searchable()
                        ->sortable()
                        ->size('base'),

                    // Usamos Stack en lugar de Split para mantener todo alineado dentro del ancho de la tarjeta
                    Stack::make([
                        TextColumn::make('category.name')
                            ->badge()
                            ->color('stone')
                            ->size('xs'),
                        
                        TextColumn::make('price')
                            ->money('MXN')
                            ->weight('bold')
                            ->color('success')
                            ->size('lg'),
                    ])->space(1),

                    TextColumn::make('sku')
                        ->color('gray')
                        ->size('xs'),
                ])->space(2),
            ])
            ->contentGrid([
                'default' => 1,
                'sm' => 2,
                'md' => 2,
                'lg' => 3,
                'xl' => 4,
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}