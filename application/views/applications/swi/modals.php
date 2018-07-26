<!-- add swi document -->
<div class="modal fade" id="add_swi_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new SWI document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_new_doc" action="<?= site_url('swi/save_document'); ?>" method="POST">
        <div class="container-fluid">
          <div class="row">
            <div class="col-4">
              <label>Document Number</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_num" required placeholder="eg DCKNT-0001-01" autocomplete="off">
            </div>
            <div class="col-4">
              <label>Document Name</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_name" required placeholder="eg Inline Inspection" autocomplete="off">
            </div>
            <div class="col-4">
              <label>Department</label>
              <?= createDropdown('dept','departments','department','',['has_swi = 1'],['form-control form-control-sm']); ?>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <table class="table table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>Process</th>
                    <th colspan="2">Principle</th>
                  </tr>
                </thead>
                <tbody id="process_table">
                  <tr id="new_process">
                    <td class="border-0">
                      <input type="text" class="form-control form-control-sm text-input process" name="process[]" placeholder="Enter process" autocomplete="off">
                    </td>
                    <td class="border-0" style='width: 35%'>
                      <?= createDropdown('principle[]','swi_principles','principle','',[],['form-control form-control-sm']); ?>
                    </td>
                    <td style='width: 5%'>
                      <button type="button" class="btn btn-sm btn-dark remove_process">&nbsp;<i class="fas fa-minus"></i>&nbsp;</button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="border-0 text-center"><a href="#" class="btn btn-sm btn-info add_process"><small>Add <i class="fas fa-plus"></i></small></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="form_submit btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm delete -->
<div class="modal fade" id="delete_swi_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm multiple delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete these Documents and their processes?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="delete_docs" type="button" class="btn btn-sm btn-danger" data-dismiss="modal">YES</button>
      </div>
    </div>
  </div>
</div>
<!-- edit swi document -->
<div class="modal fade" id="edit_swi_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit SWI document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_doc" action="<?= site_url('swi/save_document'); ?>" method="POST">
        <input type="hidden" name="doc_id" value=""/>
        <div class="container-fluid">
          <div class="row">
            <div class="col-4">
              <label>Document Number</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_num" required placeholder="eg DCKNT-0001-01" autocomplete="off">
            </div>
            <div class="col-4">
              <label>Document Name</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_name" required placeholder="eg Inline Inspection" autocomplete="off">
            </div>
            <div class="col-4">
              <label>Department</label>
              <?= createDropdown('dept','departments','department','',['has_swi = 1'],['form-control form-control-sm']); ?>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <table class="table table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>Process</th>
                    <th colspan="2">Principle</th>
                  </tr>
                </thead>
                <tbody id="eprocess_table">
                  <tr id="edit_process">
                    <td class="border-0">
                      <input type="text" class="form-control form-control-sm text-input process" name="process[]" placeholder="Enter process" autocomplete="off">
                    </td>
                    <td class="border-0" style='width: 35%'>
                      <?= createDropdown('principle[]','swi_principles','principle','',[],['form-control form-control-sm']); ?>
                    </td>
                    <td style='width: 5%'>
                      <button type="button" class="btn btn-sm btn-dark remove_process">&nbsp;<i class="fas fa-minus"></i>&nbsp;</a>
                    </td>
                  </tr>
                </tbody>
                <tbody class="border-0">
                  <tr>
                    <td colspan="2" class="border-0 text-center"><a href="#" class="btn btn-sm btn-info add_eprocess"><small>Add <i class="fas fa-plus"></i></small></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="form_submit btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- assign document -->
<div class="modal fade" id="assign_swi_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign SWI document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="assign_doc" action="<?= site_url('swi/assign_document'); ?>" method="POST">
        <div class="container-fluid">
          <div class="row">
            <div class="col-7">
              <label>Search Document</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_search" required placeholder="eg DCKNT-0001-01 or Part Master Update" autocomplete="off">
              <table id="assign_doc_table" class="table table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th>Doc Number</th>
                    <th>Doc Name</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="col-1 d-flex align-items-center">
                <i class="fas fa-caret-right fa-3x align-middle"></i>
            </div>
            <div class="col-4">
              <label>Search Associate</label>
              <input type="text" class="form-control form-control-sm text-input" name="assoc_search" required placeholder="eg Newt Scamander" autocomplete="off">
              <table id="assign_emp_table" class="table table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th>Associate</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="form_submit btn btn-sm btn-primary">Request Assignment</button>
      </div>
    </div>
  </div>
</div>