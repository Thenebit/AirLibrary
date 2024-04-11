<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AirLibrary</title>
<link rel="stylesheet" href="{{ asset('student/styles.css') }}">
</head>
<body>
<header>
  <div class="logo">AirLibrary</div>
  <div class="auth">
    <div class="dropdown" id="dropdown">
        <div class="profile" onclick="toggleDropdown()">
            <img src="{{ asset('student/IMG_0081.webp') }}" alt="Profile Icon">
            <span>{{__('Name') }}</span>
        </div>
        <div class="dropdown-content" id="dropdownContent">
            <a href="#" onclick="logout()">{{__('Logout') }}</a>
        </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="card">
    <h2>{{__('Library Documents') }}</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Author</th>
          <th>Category</th>
          <th>Upload Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($docs as $doc)
            <tr>
              <td>{{ $doc->id }}</td>
              <td> {{ $doc->title }} </td>
              <td> {{ $doc->author }} </td>
              <td> {{ $doc->category }} </td>
              <td> {{ $doc->created_at->format('M jS Y') }}</td>
              <td>
                <a href="{{ url('/read', $doc->id) }}" class="btnColor">Read</a>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownContent");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

</script>

</body>
</html>






