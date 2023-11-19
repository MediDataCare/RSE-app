<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Adicionar
    </button>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Remover</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($entitieUsers as $key => $user)
                    <td>{{$user}}</td>
                     <td><i class="fa fa-trash text-danger ms-4" aria-hidden="true" wire:click="removeUser({{ $key }})"></i></td>
            @endforeach
        </tr>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar utilizadores à entidade</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="users-multiple w-100" name="selectedUsers[]" multiple="multiple"
                            wire:model="selectedUsers"
                            data-placeholder="Selecione o Sexo">
                        @foreach($allUsers as $key => $user)
                            <option value="{{$key}}">{{$user}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        document.addEventListener("DOMContentLoaded", () => {
            $('.users-multiple').select2({
                placeholder: function () {
                    return $(this).data('placeholder');
                },
                dropdownParent: $('#exampleModal')
            });

            $(".save").click(function () {
                var data = $('.users-multiple').select2("val");
                @this.
                set('selectedUsers', data);
                Livewire.emit('addUser', data);
            });


            Livewire.hook('component.initialized', (component) => {
                $('.users-multiple').select2({
                    placeholder: function () {
                        return $(this).data('placeholder');
                    },
                    dropdownParent: $('#exampleModal')
                });
                $(".save").click(function () {
                    var data = $('.users-multiple').select2("val");
                    @this.
                    set('selectedUsers', data);
                    Livewire.emit('addUser', data);
                });

            })

            Livewire.hook('message.processed', (message, component) => {
                $('.users-multiple').select2({
                    placeholder: function () {
                        return $(this).data('placeholder');
                    },
                    dropdownParent: $('#exampleModal')
                });
                $(".save").click(function () {
                    var data = $('.users-multiple').select2("val");
                    @this.
                    set('selectedUsers', data);
                    Livewire.emit('addUser', data);
                });
            })

        });

        window.addEventListener('reloadPage', event => {
            location.reload();
        });


    </script>
</div>
