<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p><a href="{{route('student.create')}}" class="btn btn-primary">Add Student</a></p><span style="font-weight: bold; color:mediumvioletred;">Also check simple crud api on (@php echo '<a href="'.url('/api/posts').'" target="_blank">'.url('/api/posts').'<a/>'; @endphp)</span>

            <div class="py-4 px-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

               <table class="table table-bordered">
                   <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created Date</th>
                        <th>Photo</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                   </thead>
                   <tbody>
                   @forelse($students as $student)
                       <tr>
                           <td>{{$student->id}}</td>
                           <td>{{$student->name}}</td>
                           <td>{{$student->email}}</td>
                           <td>{{$student->phone}}</td>
                           <td>{{$student->created_at}}</td>
                           <td>
                               @if($student->avatar)
                                   <img src="{{ asset('storage/avatars/'.$student->avatar) }}" style="height: 100px;width:100px;">
                               @else
                                   <span>No photo found!</span>
                               @endif
                           </td>
                           <td>
                               <a href="{{route('student.edit', $student->id)}}" class="btn btn-primary">Edit</a>
                           </td>
                           <td>
                               <a href="#" class="btn btn-danger deleteStudent" data-id="{{$student->id}}">Delete</a>
                           </td>
                       </tr>
                   @empty
                       <tr>
                           <td colspan="7">Student Records Not Found</td>
                       </tr>
                   @endforelse
                   </tbody>
               </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.deleteStudent', function () {
                var id = $(this).data("id");
                var route = '{{ route('student.delete') }}';
                //alert(route+id);
                if(confirm("Are You sure want to delete this Student!")){
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {
                        id: id
                    },
                    success: function (data) {
                        //alert(data.message);
                        window.location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                } else {
                    return false;
                }
            });
        });
    </script>

</x-app-layout>
