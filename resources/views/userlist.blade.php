<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User List</title>
</head>

<body>
    <div class="container">



        <div class="row">
            <div class="col-6">
                <a href="{{ url('user/create') }}" class="btn btn-sm btn-primary mt-4">Add User</a>
                <a href="{{ url('user/logout') }}" class="btn btn-sm btn-danger mt-4">Logout</a>

            </div>

            <div class="col-6">
                <form action="{{ url('user/list') }}" class="row">
                    <div class="col-10 mt-4">

                        <input type="text" name="search" placeholder="Search Here" class="form-control"
                            value="{{ $search }}">
                    </div>
                    <div class="col-2 mt-4">

                        <button class="btn btn-success" type='submit'>Search</button>
                    </div>


                </form>
            </div>



        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Hobby</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->mo_no }}</td>
                        <td>{{ $user->hobby }}</td>
                        <td>
                            {!! $user->getimg() !!}
                        </td>
                        <td>
                            <a href="{{ url('user/edit/' . $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ url('user/delete/' . $user->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $users->appends(['search' => $search])->links() !!}

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
