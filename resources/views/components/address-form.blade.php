
    <div class="row">
        {{ csrf_field() }}


        @component('components.form-group', [ 'label' => 'CEP', 'name'=> 'zipcode', 'value' => $address->zipcode , 'readonly' => !$edit ])
        @endcomponent

        @component('components.form-group', [ 'label' => 'Endereço', 'name'=> 'address', 'value' => $address->address , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'Número', 'name'=> 'number', 'value' => $address->number , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'Complemento', 'name'=> 'complement', 'value' => $address->complement , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'Bairro', 'name'=> 'bairro', 'value' => $address->bairro , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'Cidade', 'name'=> 'city', 'value' => $address->city , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'Estado', 'name'=> 'state', 'value' => $address->state , 'readonly' => !$edit ])
        @endcomponent


        @component('components.form-group', [ 'label' => 'País', 'name'=> 'country', 'value' => $address->country , 'readonly' => !$edit ])
        @endcomponent
    </div>


