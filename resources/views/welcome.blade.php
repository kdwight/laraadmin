@extends('partials.app')

@section('content')
  <div class="row">
    <div class="col">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List of Users</h3>
            </div>

            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-success">Add User</a>
              <a href="#!" class="btn btn-sm btn-info">Roles</a>
            </div>
          </div>
        </div>
        <div class="card-body">

        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List of Users</h3>
            </div>

            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-info">Roles</a>
              <a href="#!" class="btn btn-sm btn-success">Add User</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Project</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">
                    <span class="mb-0 text-sm">Vue Paper UI Kit PRO</span>
                </td>

                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      actions
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection