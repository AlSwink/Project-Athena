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
                <tbody id="process_table" class="process_table">
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
<div class="modal fade" id="delete_swi_document" tabindex="-1" role="dialog" aria-hidden="true">
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
<div class="modal fade" id="edit_swi_document" tabindex="-1" role="dialog" aria-hidden="true">
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
                <tbody id="eprocess_table" class="process_table">
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
<div class="modal" id="assign_swi_document" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1300px;">
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
            <div class="col">
              <div class="card card-body bg-warning">
                <small>Assigning/Reassigning a document will leave the employee that the document is assigned to with no document assigned unless assigned a new one. 
                <b><i>Select an option below to reassign or create a new assignment</i></b></small>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-6">
              <label>Search Document</label>
              <input type="text" class="form-control form-control-sm text-input" name="doc_search" required placeholder="eg DCKNT-0001-01 or Part Master Update" autocomplete="off">
              <table id="assign_doc_table" class="table table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th>Doc Number</th>
                    <th>Doc Name</th>
                    <th>Department</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="col-1 d-flex align-items-center">
              <input type="hidden" name="assign_doc_id"/>
              <input type="hidden" name="reassignment_id"/>
              <input type="hidden" name="reassign_to_emp_id"/>
              <input type="hidden" name="assignment_type" value="reassign"/>
                <i class="fas fa-caret-right fa-3x align-middle"></i>
            </div>
            <div class="col-5">
              <label>Search Associate</label>
              <input type="text" class="form-control form-control-sm text-input" name="assoc_search" required placeholder="eg Newt Scamander" autocomplete="off">
              <table id="assign_emp_table" class="table table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th>Associate</th>
                    <th>Department</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="col">
              <br>
              <div id="assign_doc_alert"></div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="reassign_submit btn btn-md btn-primary">Reassign <i class="fas fa-random"></i></button>
        <!--button type="button" class="create_assignment btn btn-md btn-success">Create assignment <i class="fas fa-user-tag"></i></button-->
      </div>
    </div>
  </div>
</div>
<!-- input swi help -->
<div class="modal fade" id="help_input_swi" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1300px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select a help topic below</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="help_tabs" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="input-tab-button" data-toggle="pill" href="#input-tab" role="tab" aria-selected="true">How to input a worksheet?</a>
                <a class="nav-link" id="reset-swi-button" data-toggle="pill" href="#reset-swi" role="tab" aria-selected="true">I need to reset a worksheet</a>
                <a class="nav-link" id="reprint-swi-help-button" data-toggle="pill" href="#reprint-swi-help" role="tab" aria-selected="true">I lost a worksheet, how can I reprint?</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="input-tab" style="max-height: 60%;overflow: auto">
                <p>First thing you'll need is the physical copy of the worksheet that was provided to the employee.<br>
                There should be an <b>Assignment ID</b> on the top left corner of the worksheet.</p>
                <img src="<?= $this->config->item('help-image-dir').'/assignment_id.png';?> " width="50%"/>
                <br>
                <p>Use this ID to search on the <b>input box</b> provided in this form. This will lookup the digital copy of the worksheet for input.</p>
                <img src="<?= $this->config->item('help-image-dir').'/assignment_id_entry.png';?> " width="30%"/>
                <br>
                <p>A from will then display on the space provided with empty fields for you to fill up using the physical worksheet. This will also show some information about the worksheet.</p>
                <img src="<?= $this->config->item('help-image-dir').'/assignment_entry.png';?> " width="100%"/>
                <br>
                <p>Use the controls provided to input the worksheet. Make sure to complete the form before submission.<br>
                  The form will not let you submit unless all fields are marked as well as their corresponding comment field if needed.</p>
                <img src="<?= $this->config->item('help-image-dir').'/fill_required.png';?> " width="100%"/>
                <br>
                <p>After submission the form will be considered done and will be forwarded to the correct department and manager for reporting.</p>
                <img src="<?= $this->config->item('help-image-dir').'/signsubmit.png';?> " width="30%"/>
                <br>
                <p>and that's basically it. Good Job!</p>
              </div>
              <div class="tab-pane fade" id="reset-swi">
                <p>If for some reason you made a mistake and need to reset a saved worksheet this is what you do.</p>
                <p>Send us the assignment ID via <a href="http://10.89.98.122/index.php/ticket" target="_blank">IT helpdesk ticketing system</a>
                </p>
                <small>This feature will be added on version 1</small>
              </div>
              <div class="tab-pane fade" id="reprint-swi-help">
                <p>It is important that we don't lose the worksheet since it has the <b>assignment ID</b> responsible for inputting and lookup. But from time to time it'll happen and here's how to reprint it.</p>
                <p>If you or the employee can still remember the assignment ID simply search for it and click the Re-print Sheet.</p>
                <img src="<?= $this->config->item('help-image-dir').'/reprint_help.png';?> " width="100%"/>
                <br>
                <p>If you can't find the assignment ID, you can go to your reporting tab and look up the employee and click the assignment ID on the table and it will send you back to this screen for re-printing. <b>(if you do not have controls for this please ask your superior to do it for you)</b></p>
                <p>and if all else fails, send us a tcket via <a href="http://10.89.98.122/index.php/ticket" target="_blank">IT helpdesk ticketing system</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-success" data-dismiss="modal">Got it! <i class="fas fa-thumbs-up"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- confirm action -->
<div class="modal" id="confirm_action" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard-check"></i> Confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <h5>Are you sure you want to <span id="confirm_action_label" class="text-danger"></span> this?</h5>
          <small>This action cannot be reversed</small>
          <input type="hidden" value="" name="confirm_assignment_id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="confirm_action_submit" class="btn btn-md btn-success">Yes, I'm sure <i class="fas fa-check"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- print by dept -->
<div class="modal" id="assignment_printer" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-print"></i> Print Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="print_assignment_form" action="<?= site_url('api/get_assigned_document'); ?>" action="POST">
        <label>Criteria</label>
        <select id="print_type" class="form-control">
          <option value="all">All</option>
          <option value="assignment_id">Assignment ID</option>
          <option value="dept_id">Department</option>
          <option value="employee">Employee</option>
        </select>
        <div id="print_department" class="subselection mt-2 d-none">
          <label>Department</label>
          <?= createDropdown('dept_id','departments','department','',['has_swi = 1'],['form-control']); ?>
        </div>
        <div id="print_employee" class="subselection mt-2 d-none">
          <label>Employees</label>
          <?= createEmpDropdown('user_id','user_id',['e_fname','e_lname'],['staffing = 3'],['form-control']); ?>
        </div>
        <div id="print_assignment_id" class="subselection mt-2 d-none">
          <label>Assignment ID</label>
          <input type="text" class="form-control" name="assignment_id"/>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="print_assignment" class="btn btn-md btn-info">Print</i></button>
      </div>
    </div>
  </div>
</div>