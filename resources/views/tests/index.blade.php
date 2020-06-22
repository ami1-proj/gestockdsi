@extends('layouts.app')

@section('page')
  Tests.Index
@endsection

@section('css')

@endsection

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Colorpicker</h4>
                <p class="text-muted m-b-30 font-14">Fancy and customizable colorpicker
                    plugin for Twitter Bootstrap.</p>

                <form action="#">
                    <div class="form-group">
                        <label>Default</label>
                        <input type="text" class="colorpicker-default form-control" value="#8fff00">
                    </div>
                    <div class="form-group">
                        <label>RGBA</label>
                        <input type="text" class="colorpicker-rgba form-control" value="rgb(0,194,255,0.78)" data-color-format="rgba">
                    </div>
                    <div class="form-group m-b-0">
                        <label>As Component</label>
                        <div data-color-format="rgb" data-color="rgb(255, 146, 180)" class="colorpicker-default input-group">
                            <input type="text" readonly="readonly" value="" class="form-control">
                            <div class="input-group-append add-on">
                                <button class="btn btn-white" type="button">
                                    <i style="background-color: rgb(124, 66, 84);margin-top: 2px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Bootstrap MaxLength</h4>
                <p class="text-muted m-b-30 font-14">This plugin integrates by default with
                    Twitter bootstrap using badges to display the maximum lenght of the
                    field where the user is inserting text. </p>

                <h6 class="text-muted"><b>Default usage</b></h6>
                <p class="text-muted m-b-15 font-13">
                    The badge will show up by default when the remaining chars are 10 or less:
                </p>
                <input type="text" class="form-control" maxlength="25" name="defaultconfig" id="defaultconfig" />

                <div class="m-t-20">
                    <h6 class="text-muted"><b>Threshold value</b></h6>
                    <p class="text-muted m-b-15 font-13">
                        Do you want the badge to show up when there are 20 chars or less? Use the <code>threshold</code> option:
                    </p>
                    <input type="text" maxlength="25" name="thresholdconfig" class="form-control" id="thresholdconfig" />
                </div>

                <div class="m-t-20">
                    <h6 class="text-muted"><b>All the options</b></h6>
                    <p class="text-muted m-b-15 font-13">
                        Please note: if the <code>alwaysShow</code> option is enabled, the <code>threshold</code> option is ignored.
                    </p>
                    <input type="text" class="form-control" maxlength="25" name="alloptions" id="alloptions" />
                </div>

                <div class="m-t-20">
                    <h6 class="text-muted"><b>Position</b></h6>
                    <p class="text-muted m-b-15 font-13">
                        All you need to do is specify the <code>placement</code> option, with one of those strings. If none
                        is specified, the positioning will be defauted to 'bottom'.
                    </p>
                    <input type="text" class="form-control" maxlength="25" name="placement" id="placement" />
                </div>

                <div class="m-t-20">
                    <h6 class="text-muted"><b>textareas</b></h6>
                    <p class="text-muted m-b-15 font-13">
                        Bootstrap maxlength supports textarea as well as inputs. Even on old IE.
                    </p>
                    <textarea id="textarea" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                </div>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Datepicker</h4>
                <p class="text-muted m-b-30 font-14">Examples of twitter bootstrap datepicker.</p>

                <form action="#">
                    <div class="form-group">
                        <label>Default Functionality</label>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="datepicker">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Auto Close</label>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="datepicker-autoclose">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Multiple Date</label>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="datepicker-multiple-date">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Date Range</label>
                        <div>
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                <input type="text" class="form-control" name="end" placeholder="End Date" />
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Bootstrap TouchSpin</h4>
                <p class="text-muted m-b-30 font-14">A mobile and touch friendly input spinner component for Bootstrap</p>

                <form>
                    <div class="form-group">
                        <label class="control-label">Using data attributes</label>
                        <input id="demo0" type="text" value="55" name="demo0" data-bts-min="0" data-bts-max="100" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0" data-bts-step-interval="100" data-bts-force-step-divisibility="round" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Example with postfix (large)</label>
                        <input id="demo1" type="text" value="55" name="demo1">
                    </div>
                    <div class="form-group">
                        <label class="control-label">With prefix </label>
                        <input id="demo2" type="text" value="0" name="demo2" class=" form-control">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Init with empty value:</label>
                        <input id="demo3" type="text" value="" name="demo3">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Value attribute is not set (applying settings.initval)</label>
                        <input id="demo3_21" type="text" value="" name="demo3_21">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Value is set explicitly to 33 (skipping settings.initval) </label>
                        <input id="demo3_22" type="text" value="33" name="demo3_22">
                    </div>

                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('js')
  
@endsection
