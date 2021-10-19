<div class="card-body">
    <h5 class="card-title mb-1">{{ $edu->name }}
        @if (request()->has('edit_profile'))
            <div style="float: right" class="row">
                <a class="fa fa-pencil editable-btn-dark" data-toggle="modal" id="edu_UpModal_btn"
                    data-id="{{ $edu->id }}"></a>
                <form action="{{ route('education.destory', $edu) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: transparent; border: 1px solid #fff;"><i
                            class="fa fa-times editable-btn-dark" onclick="return confirm('Are you sure you want to delete this?')"></i></button>
                </form>

            </div>
        @endif
    </h5>
    <p class="font-size-xs">{{ $edu->subjects }}</p>
    <p class="font-size-ms">{{ $edu->addmission_year }} to {{ $edu->grad_year }}</p>
    <p class="card-text bold"><b>{{ $edu->country }}</b></p>
</div>

{{-- Education Modal --}}
<div class="modal fade" id="education_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Education')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduaction_update_form" method="post">
                    <input type="hidden" id="edu_id">
                    <label class="font-size-ms font-weight-bold" for="country">{{__('Country')}}</label>
                    <select class="custom-select" id="country_update" name="country">
                        <option value="" selected="selected">Please Select Your Country / 국가를 선택하십시</option>
                        @foreach (App\Models\Country::all() as $item)
                            <option value="{{ $item->name }}">
                                {{ $item->name }} -
                                {{ $item->code }}</option>
                        @endforeach
                    </select>
                    <label for="name">{{__('UniversityCollege')}}:</label>
                    <input type="text" name="name" class="form-control" id="name_update">
                    <label for="subjects">{{__('Major')}}:</label>
                    <input type="text" name="subjects" class="form-control" id="subjects_update">
                    <label for="addmission_year">{{__('AdmissionYear')}}:</label>
                    <select name="addmission_year" class="form-control" id="addmission_year_update">
                        <option value="2000" {{ $edu->addmission_year == '2000' ? 'selected' : '' }}>2000</option>
                        <option value="2001" {{ $edu->addmission_year == '2001' ? 'selected' : '' }}>2001</option>
                        <option value="2002" {{ $edu->addmission_year == '2002' ? 'selected' : '' }}>2002</option>
                        <option value="2003" {{ $edu->addmission_year == '2003' ? 'selected' : '' }}>2003</option>
                        <option value="2004" {{ $edu->addmission_year == '2004' ? 'selected' : '' }}>2004</option>
                        <option value="2005" {{ $edu->addmission_year == '2005' ? 'selected' : '' }}>2005</option>
                        <option value="2006" {{ $edu->addmission_year == '2006' ? 'selected' : '' }}>2006</option>
                        <option value="2007" {{ $edu->addmission_year == '2007' ? 'selected' : '' }}>2007</option>
                        <option value="2008" {{ $edu->addmission_year == '2008' ? 'selected' : '' }}>2008</option>
                        <option value="2009" {{ $edu->addmission_year == '2009' ? 'selected' : '' }}>2009</option>
                        <option value="2010" {{ $edu->addmission_year == '2010' ? 'selected' : '' }}>2010</option>
                        <option value="2011" {{ $edu->addmission_year == '2011' ? 'selected' : '' }}>2011</option>
                        <option value="2012" {{ $edu->addmission_year == '2012' ? 'selected' : '' }}>2012</option>
                        <option value="2013" {{ $edu->addmission_year == '2013' ? 'selected' : '' }}>2013</option>
                        <option value="2014" {{ $edu->addmission_year == '2014' ? 'selected' : '' }}>2014</option>
                        <option value="2015" {{ $edu->addmission_year == '2015' ? 'selected' : '' }}>2015</option>
                        <option value="2016" {{ $edu->addmission_year == '2016' ? 'selected' : '' }}>2016</option>
                        <option value="2017" {{ $edu->addmission_year == '2017' ? 'selected' : '' }}>2017</option>
                        <option value="2018" {{ $edu->addmission_year == '2018' ? 'selected' : '' }}>2018</option>
                        <option value="2019" {{ $edu->addmission_year == '2019' ? 'selected' : '' }}>2019</option>
                        <option value="2020" {{ $edu->addmission_year == '2020' ? 'selected' : '' }}>2020</option>
                        <option value="2021" {{ $edu->addmission_year == '2021' ? 'selected' : '' }}>2021</option>
                        <option value="2022" {{ $edu->addmission_year == '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2023" {{ $edu->addmission_year == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ $edu->addmission_year == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $edu->addmission_year == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ $edu->addmission_year == '2026' ? 'selected' : '' }}>2026</option>
                        <option value="2027" {{ $edu->addmission_year == '2027' ? 'selected' : '' }}>2027</option>
                        <option value="2028" {{ $edu->addmission_year == '2028' ? 'selected' : '' }}>2028</option>
                        <option value="2029" {{ $edu->addmission_year == '2029' ? 'selected' : '' }}>2029</option>
                        <option value="2030" {{ $edu->addmission_year == '2030' ? 'selected' : '' }}>2030</option>
                        <option value="2031" {{ $edu->addmission_year == '2031' ? 'selected' : '' }}>2031</option>
                        <option value="2032" {{ $edu->addmission_year == '2032' ? 'selected' : '' }}>2032</option>
                        <option value="2033" {{ $edu->addmission_year == '2033' ? 'selected' : '' }}>2033</option>
                        <option value="2034" {{ $edu->addmission_year == '2034' ? 'selected' : '' }}>2034</option>
                        <option value="2035" {{ $edu->addmission_year == '2035' ? 'selected' : '' }}>2035</option>
                        <option value="2036" {{ $edu->addmission_year == '2036' ? 'selected' : '' }}>2036</option>
                        <option value="2037" {{ $edu->addmission_year == '2037' ? 'selected' : '' }}>2037</option>
                        <option value="2038" {{ $edu->addmission_year == '2038' ? 'selected' : '' }}>2038</option>
                        <option value="2039" {{ $edu->addmission_year == '2039' ? 'selected' : '' }}>2039</option>
                        <option value="2040" {{ $edu->addmission_year == '2040' ? 'selected' : '' }}>2040</option>

                    </select>
                    <label for="grad_year">{{__('GraduationYear')}}:</label>
                    <select name="grad_year" class="form-control" id="grad_year_update">
                        <option value="2000" {{ $edu->grad_year == '2000' ? 'selected' : '' }}>2000</option>
                        <option value="2001" {{ $edu->grad_year == '2001' ? 'selected' : '' }}>2001</option>
                        <option value="2002" {{ $edu->grad_year == '2002' ? 'selected' : '' }}>2002</option>
                        <option value="2003" {{ $edu->grad_year == '2003' ? 'selected' : '' }}>2003</option>
                        <option value="2004" {{ $edu->grad_year == '2004' ? 'selected' : '' }}>2004</option>
                        <option value="2005" {{ $edu->grad_year == '2005' ? 'selected' : '' }}>2005</option>
                        <option value="2006" {{ $edu->grad_year == '2006' ? 'selected' : '' }}>2006</option>
                        <option value="2007" {{ $edu->grad_year == '2007' ? 'selected' : '' }}>2007</option>
                        <option value="2008" {{ $edu->grad_year == '2008' ? 'selected' : '' }}>2008</option>
                        <option value="2009" {{ $edu->grad_year == '2009' ? 'selected' : '' }}>2009</option>
                        <option value="2010" {{ $edu->grad_year == '2010' ? 'selected' : '' }}>2010</option>
                        <option value="2011" {{ $edu->grad_year == '2011' ? 'selected' : '' }}>2011</option>
                        <option value="2012" {{ $edu->grad_year == '2012' ? 'selected' : '' }}>2012</option>
                        <option value="2013" {{ $edu->grad_year == '2013' ? 'selected' : '' }}>2013</option>
                        <option value="2014" {{ $edu->grad_year == '2014' ? 'selected' : '' }}>2014</option>
                        <option value="2015" {{ $edu->grad_year == '2015' ? 'selected' : '' }}>2015</option>
                        <option value="2016" {{ $edu->grad_year == '2016' ? 'selected' : '' }}>2016</option>
                        <option value="2017" {{ $edu->grad_year == '2017' ? 'selected' : '' }}>2017</option>
                        <option value="2018" {{ $edu->grad_year == '2018' ? 'selected' : '' }}>2018</option>
                        <option value="2019" {{ $edu->grad_year == '2019' ? 'selected' : '' }}>2019</option>
                        <option value="2020" {{ $edu->grad_year == '2020' ? 'selected' : '' }}>2020</option>
                        <option value="2021" {{ $edu->grad_year == '2021' ? 'selected' : '' }}>2021</option>
                        <option value="2022" {{ $edu->grad_year == '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2023" {{ $edu->grad_year == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ $edu->grad_year == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $edu->grad_year == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ $edu->grad_year == '2026' ? 'selected' : '' }}>2026</option>
                        <option value="2027" {{ $edu->grad_year == '2027' ? 'selected' : '' }}>2027</option>
                        <option value="2028" {{ $edu->grad_year == '2028' ? 'selected' : '' }}>2028</option>
                        <option value="2029" {{ $edu->grad_year == '2029' ? 'selected' : '' }}>2029</option>
                        <option value="2030" {{ $edu->grad_year == '2030' ? 'selected' : '' }}>2030</option>
                        <option value="2031" {{ $edu->grad_year == '2031' ? 'selected' : '' }}>2031</option>
                        <option value="2032" {{ $edu->grad_year == '2032' ? 'selected' : '' }}>2032</option>
                        <option value="2033" {{ $edu->grad_year == '2033' ? 'selected' : '' }}>2033</option>
                        <option value="2034" {{ $edu->grad_year == '2034' ? 'selected' : '' }}>2034</option>
                        <option value="2035" {{ $edu->grad_year == '2035' ? 'selected' : '' }}>2035</option>
                        <option value="2036" {{ $edu->grad_year == '2036' ? 'selected' : '' }}>2036</option>
                        <option value="2037" {{ $edu->grad_year == '2037' ? 'selected' : '' }}>2037</option>
                        <option value="2038" {{ $edu->grad_year == '2038' ? 'selected' : '' }}>2038</option>
                        <option value="2039" {{ $edu->grad_year == '2039' ? 'selected' : '' }}>2039</option>
                        <option value="2040" {{ $edu->grad_year == '2040' ? 'selected' : '' }}>2040</option>

                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="education-update-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
