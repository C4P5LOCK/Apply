<div>

    <input type="text"
           wire:model.live="search"
           placeholder="Search applications..."
           class="border rounded p-3 w-full mb-4">

    <table class="w-full border">

        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">School</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($applications as $application)

                <tr class="border-b">
                    <td class="p-3">
                        {{ $application->full_name }}
                    </td>

                    <td class="p-3">
                        {{ $application->school }}
                    </td>

                    <td class="p-3">
                        {{ ucfirst($application->status) }}
                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="mt-4">
        {{ $applications->links() }}
    </div>

</div>