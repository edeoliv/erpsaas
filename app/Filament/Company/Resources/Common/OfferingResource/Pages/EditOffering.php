<?php

namespace App\Filament\Company\Resources\Common\OfferingResource\Pages;

use App\Concerns\RedirectToListPage;
use App\Filament\Company\Resources\Common\OfferingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditOffering extends EditRecord
{
    use RedirectToListPage;

    protected static string $resource = OfferingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['attributes'] = array_filter([
            $data['sellable'] ? 'Sellable' : null,
            $data['purchasable'] ? 'Purchasable' : null,
        ]);

        return parent::mutateFormDataBeforeFill($data); // TODO: Change the autogenerated stub
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $attributes = array_flip($data['attributes'] ?? []);

        $data['sellable'] = isset($attributes['Sellable']);
        $data['purchasable'] = isset($attributes['Purchasable']);

        unset($data['attributes']);

        return parent::handleRecordUpdate($record, $data); // TODO: Change the autogenerated stub
    }
}
