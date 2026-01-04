<div>
    <h2 class="text-2xl">
        Manage Units
    </h2>
    <table class="table">
        <thead>
            <tr>
                <td>
                    Unit Name
                </td>
                <td>
                    Unit Abbreviation
                </td>
                <td>
                    Countable
                </td>
            </tr>
        </thead>
        <tbody>

            @foreach ($this->units as $unit)
                <tr>
                    <td>
                        {{ $unit->name }}
                    </td>
                    <td>
                        {{ $unit->abbreviation }}
                    </td>
                    <td>
                        {{ $unit->countable ? 'Yes' : 'No' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
