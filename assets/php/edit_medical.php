<?php

$form = '<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Τίτλος *</label>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <input type="text" class="form-control" name="title" placeholder="">
            <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τίτλο</span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Σε ποιο είδος παρατηρήσατε συμπτώματα *</label>
        <div class="col-lg-5 col-md-5 col-sm-12 form-group-sub">
            <select class="form-control" name="type">
                <option value=""></option>
                <option id="1" value="Αγελάδα">Αγελάδα</option>
                <option id="2" value="Πρόβατο">Πρόβατο</option>
                <option id="3" value="Αίγια">Αίγια</option>															
                <option id="4" value="Γουρούνι">Γουρούνι</option>															
            </select>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε είδος</span>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Σε ποια φυλή παρατηρήσατε συμπτώματα  *</label>
        <div class="col-lg-5 col-md-5 col-sm-12 form-group-sub">
            <select class="form-control" name="species">
                <option value=""></option>															
            </select>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε φυλή</span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Που παρατηρήσατε συμπτώματα για πρώτη φορά *</label>
        <div class="col-lg-6 col-md-6  col-sm-12">
            <div class="kt-radio-inline">
                <label class="kt-radio">
                            <input type="radio" name="radio" value="Μεμονομένο ζώο" id="animal"> Μεμονομένο ζώο 
                            <span></span>
                        </label>
                        <label class="kt-radio">
                            <input type="radio" name="radio" value="Ηλιακό Γρουπ (συγεκριμένος αριθμό ζώων)" id="animals_group_age_number"> Ηλιακό Γρουπ (συγεκριμένος αριθμό ζώων) 
                            <span></span>
                        </label>
                        <label class="kt-radio">
                            <input type="radio" name="radio" value="Ολόκληρο Ηλιακό Γρουπ" id="animals_group_age"> Ολόκληρο Ηλιακό Γρουπ  
                            <span></span>
                        </label>
                        <label class="kt-radio">
                            <input type="radio" name="radio" value="Όλα τα ζώα του είδους" id="all_animals_type"> Όλα τα ζώα του είδους  
                            <span></span>
                        </label>

                        <label class="kt-radio">
                            <input type="radio" name="radio" value="Όλα τα ζώα της φυλής" id="all_animals_species"> Όλα τα ζώα της φυλής  
                            <span></span>
                        </label>
            </div>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε μια επιλογή</span>
        </div>
    </div>



    <div class="form-group row" id="dynamic_area_1" style="display:none">
    </div>
    
    <div class="form-group row" id="dynamic_area_2" style="display:none">
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Ημ. παρατήρησης συμπτώματος *</label>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="input-group date">
                <input type="text" class="form-control" autocomplete="off" name="date" placeholder="" id="kt_datetimepicker_6">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-calendar glyphicon-th"></i>
                    </span>
                </div>
            </div>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε ημερομηνία</span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Σχόλια *</label>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <textarea class="form-control" id="" name="notes" rows="3"></textarea>
            <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε σχόλια</span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Επικοινωνία με κτηνίατρο *</label>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <select class="form-control" name="vet_contact">
                <option value=""></option>
                <option value="Ναι">Ναι</option>
                <option value="Όχι">Όχι</option>															
            </select>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε μια επιλογή</span>
        </div>
    </div>

    <div class="form-group row" id="vet_instruction" style="display:none">
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Εκτίμηση κινδύνου *</label>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <select class="form-control" name="assessment">
                <option value=""></option>
                <option value="Χαμηλή">Χαμηλή</option>
                <option value="Μέτρια">Μέτρια</option>
                <option value="Υψηλή">Υψηλή</option>															
            </select>
            <span class="form-text text-muted">Παρακαλώ επιλέξτε μια επιλογή</span>
        </div>
    </div>


    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-lg-9 ml-lg-auto">
                    <button type="submit" id="medical_confirm" class="btn btn-brand">Καταχώρηση</button>
                    <button type="reset" class="btn btn-secondary">Ακύρωση</button>
                </div>
            </div>
        </div>
    </div>';

echo $form;