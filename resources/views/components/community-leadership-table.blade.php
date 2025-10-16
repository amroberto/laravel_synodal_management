<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-tie"></i> Lideranças da Comunidade</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="leadershipTable">
                <thead>
                    <tr>
                        <th>Líder</th>
                        <th>Posição</th>
                        <th style="width: 120px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if($community && $community->leaderships->isNotEmpty())
                        @foreach($community->leaderships as $leadership)
                            <tr>
                                <td>
                                    <select name="leaderships[]['leadership_id']" class="form-control @error('leaderships.*.leadership_id') is-invalid @enderror" required>
                                        <option value="">Selecione uma liderança</option>
                                        @foreach($leaderships as $lead)
                                            <option value="{{ $lead->id }}" {{ $leadership->id == $lead->id ? 'selected' : '' }}>
                                                {{ $lead->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('leaderships.*.leadership_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select name="leaderships[]['position_id']" class="form-control @error('leaderships.*.position_id') is-invalid @enderror" required>
                                        <option value="">Selecione um cargo</option>
                                        @foreach($positions as $pos)
                                            <option value="{{ $pos->id }}" {{ $leadership->pivot->position_id == $pos->id ? 'selected' : '' }}>
                                                {{ $pos->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('leaderships.*.position_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">
                                        <i class="fas fa-trash"></i> Remover
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <select name="leaderships[]['leadership_id']" class="form-control @error('leaderships.*.leadership_id') is-invalid @enderror" required>
                                    <option value="">Selecione um líder</option>
                                    @foreach($leaderships as $lead)
                                        <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                                    @endforeach
                                </select>
                                @error('leaderships.*.leadership_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select name="leaderships[]['position_id']" class="form-control @error('leaderships.*.position_id') is-invalid @enderror" required>
                                    <option value="">Selecione um cargo</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                    @endforeach
                                </select>
                                @error('leaderships.*.position_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fas fa-trash"></i> Remover
                                </button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="addLeadership" class="btn btn-primary">
            <i class="fas fa-plus"></i> Adicionar Liderança
        </button>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function() {
            $('#addLeadership').click(function() {
                var row = `
                    <tr>
                        <td>
                            <select name="leaderships[]['leadership_id']" class="form-control" required>
                                <option value="">Selecione uma liderança</option>
                                @foreach($leaderships as $lead)
                                    <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="leaderships[]['position_id']" class="form-control" required>
                                <option value="">Selecione um cargo</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </td>
                    </tr>`;
                $('#leadershipTable tbody').append(row);
            });

            $(document).on('click', '.remove-row', function() {
                if ($('#leadershipTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('Pelo menos uma liderança é necessária.');
                }
            });
        });
    </script>
@endsection