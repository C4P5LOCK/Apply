<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-8 rounded-lg shadow">

                <h2 class="text-2xl font-bold mb-6">
                    Admin Dashboard
                </h2>

                <table class="w-full border">

                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">School</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Passport</th>
                            <th class="p-3 text-left">Action</th>
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

                                <td class="p-3">

                                    @if($application->passport)

                                        <img src="{{ asset('storage/' . $application->passport) }}"
                                             class="w-16 h-16 object-cover rounded">

                                    @endif

                                </td>
                                
                                <td class="p-3">
                                    
                                    <a href="{{ route('admin.application.show', $application) }}"
                                         class="bg-black text-white px-4 py-2 rounded">
                                        View
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>