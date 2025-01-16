@extends('Layouts.master')

@section('head')
    <!-- Add your stylesheets or head content here -->
@endsection

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Manage Lead</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-800 text-white border-b">
                    <tr>
                        <th class="py-3 px-6 text-left">S.No</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Lead Generation Date</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Payment Sent</th>
                        <th class="py-3 px-6 text-left">Prescription Link</th>
                        <th class="py-3 px-6 text-left">Converted to Order</th>
                        <th class="py-3 px-6 text-left">View Form Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $index => $lead)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-50">
                            <td class="py-4 px-6 border-b border-gray-300">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->first_name }} {{ $lead->last_name }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->generated_on }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->email }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->payment_link ? 'Yes' : 'No' }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->prescription_link ? 'Yes' : 'No' }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">{{ $lead->converted_to_order ? 'Yes' : 'No' }}</td>
                            <td class="py-4 px-6 border-b border-gray-300">
    <a href="{{ route('leads.show', $lead->id) }}" class="text-blue-500 hover:underline">View</a>
</td>
 </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- used to pagination --}}
            <div class="pagination">
                {{ $leads->links() }}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Add your footer content here -->
@endsection
