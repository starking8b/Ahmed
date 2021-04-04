<div class="row">
    <div class="form-group col-md-12">

        <div class="custom-control custom-switch custom-switch-success">
            <p class="mb-50">Enable API</p>
            <input type="checkbox" class="custom-control-input" id="apiswitch"   />
            <label class="custom-control-label" for="apiswitch">
                <span class="switch-icon-left"><i data-feather="check"></i></span>
                <span class="switch-icon-right"><i data-feather="x"></i></span>
            </label>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label class="form-label" for="basic-icon-default-email">Login(API)</label>
        <div class="input-group mb-2">


            <input type="text" class="form-control"  id="login_api" name="login_api" placeholder="Login API" aria-label="Login API" />

        </div>
    </div>
    <div class="form-group col-md-12">
        <label class="form-label" for="basic-icon-default-email">Password(API)</label>
        <div class="input-group mb-2">


            <input type="text" class="form-control"  id="password" name="password" placeholder="Password" aria-label="Password" />

        </div>
    </div>
    <div class="form-group col-md-12">
        <label class="form-label" for="basic-icon-default-email">Port(API)</label>
        <div class="input-group mb-2">


            <input type="text" class="form-control"  id="port" name="port" placeholder="Simultaneous Usage" aria-label="PORT" />

        </div>
    </div>
    <div class="form-group col-md-12">

        <button type="button" id="save_api" status='add' class="btn btn-primary mr-1 data-submit">Save</button>
        <button type="button" id="test_API"  class="btn btn-primary mr-1 data-submit">Test Connection</button>
    </div>

</div>