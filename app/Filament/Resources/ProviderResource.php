<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderResource\Pages\EditProvider;
use App\Filament\Resources\ProviderResource\Pages\ListProviders;
use App\Filament\Resources\ProviderResource\RelationManagers\HardwareRelationManager;
use App\Filament\Resources\ProviderResource\RelationManagers\PeripheralsRelationManager;
use App\Filament\Resources\ProviderResource\RelationManagers\SoftwareRelationManager;
use App\Models\Provider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Column;

class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'bookmark';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        Column::configureUsing(function (Column $column): void {
            $column
                ->toggleable()
                ->searchable()
                ->sortable();
        });

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            HardwareRelationManager::class,
            SoftwareRelationManager::class,
            PeripheralsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProviders::route('/'),
            // 'create' => Pages\CreateProvider::route('/create'),
            'edit' => EditProvider::route('/{record}/edit'),
        ];
    }
}
