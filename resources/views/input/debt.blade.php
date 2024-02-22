@extends('index')
@section('container')
    <div class="pagetitle">
        <h1>Debt</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Table</a></li>
                <li class="breadcrumb-item active">Debt</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">General Form Elements</h5>

                    <!-- General Form Elements -->
                    <form action="/Debt/input" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Creditor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="creditor" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Expense</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="incomes" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Comment</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="comments" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Document</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFile" name="documents" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Submit Button</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>


                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    <b>Creditor</b>
                  </th>
                  <th>Tax Id</th>
                  
                  <th>Money</th>
                  <th>Comments</th>
                  <th>Input Date</th>
                  <th>Doc</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($taxs as $tax)
                @foreach ($tax->income as $incomes)
                @foreach ($tax->comment as $comments)
                @foreach ($tax->document as $documents)
                <tr>
                  <td>{{$tax->creditor}}</td>
                  <td>{{$tax->id}}</td>
                  <td>{{$incomes->incomes}}</td>
                  <td>{{$comments->comments}}</td>
                  <td>{{$tax->created_at}}</td>
                  <td>{{$documents->documents}}</td>
                </tr>
                @endforeach
                @endforeach
            @endforeach
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
@endsection
