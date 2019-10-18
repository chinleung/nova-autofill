<?php

namespace ChinLeung\NovaAutofill;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaAutofillServiceProvider
{
    /**
     * Boostrap the application by adding a macro to the fields.
     *
     * @return void
     */
    public function boot() : void
    {
        Field::macro(
            'autofill',
            function (string $attribute = null) {
                $request = app(NovaRequest::class);

                $shouldAutofill = $request->isCreateOrAttachRequest()
                    && ($instance = $request->findParentModel());

                if ($shouldAutofill) {
                    $this->withMeta([
                        'value' => $instance->{$attribute ?? $this->attribute},
                    ]);
                }

                return $this;
            }
        );
    }
}
