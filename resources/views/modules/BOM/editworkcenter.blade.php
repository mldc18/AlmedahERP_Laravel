<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/workcenter_native.js') }}"></script>
<script src="{{ asset('js/newWorkcenter.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Edit Work Center</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="responsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="button"
                        onclick="loadworkcenterlist();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" id="save_wc"
                        style="float: left;" onclick="">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="wc_success_msg" class="alert alert-success" style="display: none;">
</div>

<div id="wc_alert_msg" class="alert alert-danger" style="display: none;">
</div>
<form action="" method="post" id="newworkcenter" class="create">
    <br>
    <div class="container">
        <form id="editworkcenter" name="editworkcenter" role="form">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Work_Center_Code">Work Center Code</label>

                        <input type="text" name="edit_Work_Center_Code" id="edit_Work_Center_Code"
                            value="{{ $wc->wc_code }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Work_Center_label">Work Center Label</label>
                        <input type="text" name="edit_Work_Center_label" id="edit_Work_Center_label"
                            value="{{ $wc->wc_label }}" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="Type">Type</label>
                        <select class="form-control" id="wc_select" onchange="showForm()">
                            <option value="{{ $wc->wc_type }}" selected hidden>{{ $wc->wc_type }}</option>
                            <option value="Human">Human</option>
                            <option value="Machine">Machine</option>
                            <option value="Human and Machine">Human & Machine</option>
                        </select>
                    </div>
                </div>
                <div class="col-8">
                    <div id="f1" style="display:none">
                        <label>Human</label>
                        <table class="table border-bottom table-hover table-bordered" id="operations">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td class="text-center">Employee Name</td>
                                    <td class="text-center">Hours</td>
                                    <td class="text-center">Minutes</td>
                                    <td class="text-center">Seconds</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="" id="newemployee-input-rows">
                                <tr id="employee-1">
                                    <td id="mr-code-input" class="mr-code-input"><input type="text" value=""
                                            name="Employee_name" list="employees" id="Employee_name"
                                            class="form-control">
                                    </td>
                                    <datalist id="employees">

                                        <option value="">

                                        </option>

                                    </datalist>
                                    <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                            name="Employee_hours" id="Employee_hours" class="form-control"></td>
                                    <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                            name="Employee_minutes" id="Employee_minutes" class="form-control"></td>
                                    <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                            name="Employee_seconds" id="Employee_seconds" class="form-control"></td>
                                    <td>
                                        <a id="" class="btn delete-btn" href="#" role="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <td colspan="7" rowspan="5">
                            <button type="button" onclick="addRownewEmployee()"
                                class="btn btn-sm btn-sm btn-secondary">Add
                                Row</button>
                        </td>
                        <br>
                    </div>
                    <div class="col-8">
                        @if (!is_null($machine))
                            <div id="f2" style="display:none">
                                <br>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Available_Machine">Available Machine</label>
                                        <select class="form-control" id="Available_Machine">
                                            <option value="n/a">
                                                <li>No Option</li>
                                            </option>

                                            <option value="">

                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <label>Machine</label>
                                <table class="table border-bottom table-hover table-bordered" id="operations">
                                    <thead class="border-top border-bottom bg-light">
                                        <tr class="text-muted">
                                            <td class="text-center">Machine Process</td>
                                            <td class="text-center">Setup Time</td>
                                            <td class="text-center">Running Time</td>
                                        </tr>
                                    </thead>
                                    <tbody class="" id="newmachine-input-rows">
                                        <tr data-id="${nextID}">
                                            <td id="mr-code-input" class="mr-code-input">
                                                <input type="text" value="{{ $machine->machine_process }}" readonly
                                                    name="machine_process" id="machine_process" class="form-control">
                                            </td>
                                            <td style="width: 10%;" class="mr-qty-input">
                                                <input type="number" value="{{ $machine->setup_time }}" readonly name="setup_time" id="setup_time"
                                                    class="form-control">
                                            </td>
                                            <td style="width: 10%;" class="mr-qty-input">
                                                <input type="text" value="{{ $machine->running_time }}" readonly name="Running_time"
                                                    id="Running_time" class="form-control">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <br>
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Production_Capacity">Production Capacity</label>
                        <input type="number" min="1" name="edit_Production_Capacity" id="edit_Production_Capacity"
                            value="{{ $wc->production_capacity }}" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Electricity_Cost">Electricity Cost</label>
                        <input type="number" min="1" name="edit_Electricity_Cost" id="edit_Electricity_Cost"
                            value="{{ $wc->electricity_cost }}" class="form-control hour_rate_compu">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Consumable_Cost">Consumable Cost</label>
                        <input type="number" min="1" name="edit_Consumable_Cost" id="edit_Consumable_Cost"
                            value="{{ $wc->consumable_cost }}" class="form-control hour_rate_compu">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Rent_Cost">Rent Cost</label>
                        <input type="number" min="1" name="edit_Rent_Cost" id="edit_Rent_Cost"
                            value="{{ $wc->rent_cost }}" class="form-control hour_rate_compu">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Wages">Wages</label>
                        <input type="number" min="1" name="edit_Wages" id="edit_Wages" value="{{ $wc->wages }}"
                            class="form-control hour_rate_compu">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edit_Hour_rate">Hour Rate</label>
                        <input type="number" value="0" min="0" name="edit_Hour_rate" id="edit_Hour_rate"
                            value="{{ $wc->hour_rate }}" class="form-control" readonly>
                    </div>
                </div>
            </div>
    </div>
</form>