<!DOCTYPE html>
<html lang="per" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD App Laravel & Ajax</title>
  <link rel="stylesheet" href="app.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
  href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">زیادکردنی ئەندامی نوێ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">ناوی یەکەم</label>
              <input type="text" name="fname" class="form-control" placeholder="ناوی یەکەم" required>
            </div>
            <div class="col-lg">
              <label for="lname">ناوی دووەم</label>
              <input type="text" name="lname" class="form-control" placeholder="ناوی دووەم" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">ئیمەیڵ</label>
            <input type="email" name="email" class="form-control" placeholder="ئیمەیڵ" required>
          </div>
          <div class="my-2">
            <label for="phone">ژ.تەلەفۆن</label>
            <input type="tel" name="phone" class="form-control" placeholder="ژ.تەلەفۆن" required>
          </div>
          <div class="my-2">
            <label for="post">پلە</label>
            <input type="text" name="post" class="form-control" placeholder="پلە" required>
          </div>
          <div class="my-2">
            <label for="avatar">هەڵبژاردنی وێنە</label>
            <input type="file" name="avatar" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary bg-danger" data-bs-dismiss="modal">داخستن</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">زیادکردن</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">دەستکاریکردن</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">ناوی یەکەم</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="ناوی یەکەم" required>
            </div>
            <div class="col-lg">
              <label for="lname">ناوی دووەم</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="ناوی دووەم" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">ئیمەیڵ</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="ئیمەیڵ" required>
          </div>
          <div class="my-2">
            <label for="phone">ژ.تەلەفۆن</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="ژ.تەلەفۆن" required>
          </div>
          <div class="my-2">
            <label for="post">پلە</label>
            <input type="text" name="post" id="post" class="form-control" placeholder="پلە" required>
          </div>
          <div class="my-2">
            <label for="avatar">وێنە</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary bg-danger" data-bs-dismiss="modal">داخستن</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success bg-success">نوێکردنەوە</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

<body class="bg-light" style="background-color: brown;">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">بەڕێوەبردنی ئەندامەکان</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>زیادکردنی ئەندامی نوێ</button>
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">چاوەڕوانبە...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new employee ajax request
      $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('زیادکردن...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'زیادکرا!',
                'ئەندامەکە بە سەرکەوتوویی زیادکرا!',
                'سەرکەوتووبوو'
              )
              fetchAllEmployees();
            }
            $("#add_employee_btn").text('زیادکردنی ئەندام');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#fname").val(response.first_name);
            $("#lname").val(response.last_name);
            $("#email").val(response.email);
            $("#phone").val(response.phone);
            $("#post").val(response.post);
            $("#avatar").html(
              `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_avatar").val(response.avatar);
          }
        });
      });

      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('نوێکردنەوە...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'نوێکرایەوە!',
                'ئەندامەکە بە سەرکەوتوویە نوێکرایەوە!',
                'سەرکەوتووبوو'
              )
              fetchAllEmployees();
            }
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
          }
        });
      });

      // delete employee ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'تۆ دڵنیایی؟',
          text: "ناتوانیت ئەمە بگەڕێنیتەوە",
          icon: 'ئاگاداربە',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'هەڵوەشاندنەوه',
          confirmButtonText: 'بەڵێ، بیسڕەوە'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'سڕینەوە',
                  'داتاکە سڕایەوە',
                  'سەرکەوتووبوو'
                )
                fetchAllEmployees();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      fetchAllEmployees();

      function fetchAllEmployees() {
        $.ajax({
          url: '{{ route('fetchAll') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_employees").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
  
</body>

</html>