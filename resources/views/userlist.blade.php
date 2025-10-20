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
                <a href="{{url('user/create')}}" class="btn btn-sm btn-danger mt-4">Add User</a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Index</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Mobile</th>
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
              <td>
                <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{url('user/delete/'.$user->id)}}" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>