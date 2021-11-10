<?php

namespace ChinLeung\NovaAutofill;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaAutofillServiceProvider extends ServiceProvider
{
    /**
     * Boostrap the application by adding a macro to the fields.
     *
     * @return void
     */
    public function boot(): void
    {
        Field::macro('autofill', function (string $attribute = null) {
            $request = app(NovaRequest::class);

            $shouldAutofill = $request->isCreateOrAttachRequest()
                && ($instance = $request->findParentModel());

            if ($shouldAutofill) {
                $this->withMeta([
                    'value' => Arr::get(
                        $instance,
                        $attribute ?? $this->attribute
                    ),
                ]);
            }

            return $this;
        });
    }
}
