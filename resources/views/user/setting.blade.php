@extends('layouts.app')
@section('content')
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="./project-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                    Projects</a>
                <a href="./contest-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Contests</a>
                <a href="./browse-category.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Categories</a>
                <a href="./showcase.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
                <a href="./contest-post.html" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
            </div>
        </div>
    </div>

    <section class="container py-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills sticky-top" style="top: 5rem;" 
                    aria-orientation="vertical">
                    <a class="nav-link px-3 py-2 active" 
                        href="{{ route('/setting/profile') }}"  
                       >
                        <i class="fa fa-user mr-1"></i>
                        Profile
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/notification') }}"
                    >
                        <i class="fa fa-envelope-open mr-1"></i>
                        Notification
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/password') }}" >
                        <i class="fa fa-unlock mr-1"></i>
                        Password
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        Account
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" >
                    <div class="tab-pane fade show active" >
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">Set Profile Information</h1>
                        </div>
                        <div class="p-5">
                            <form action="{{ route('/setting/profile') }}" method="post">
                                @csrf
                                <h2 class="font-weight-bold pb-2">Profile Information</h2>
                                <hr>
                                <h6 class="font-weight-bold pb-2">Name</h6>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="name">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter Your Full Name" name="name"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">Address</h6>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="address">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Enter Your Address" name="address"
                                                value="{{ auth()->user()->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="city">City</label>
                                            <input type="text" class="form-control" id="city" placeholder="Enter Your City"
                                                name="city" value="{{ auth()->user()->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="zipCode">Zip Code</label>
                                            <input type="text" class="form-control" id="zipCode"
                                                placeholder="Enter Your Zip Code" name="zipcode"
                                                value="{{ auth()->user()->zipcode }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="state">State/Province</label>
                                            <input type="text" class="form-control" id="state"
                                                placeholder="Enter Your State/Province" name="state"
                                                value="{{ auth()->user()->state }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="country">Country</label>
                                            <select class="custom-select" id="country" name="country">
                                                <option value="?" selected="selected"></option>
                                                <option label="Afghanistan" value="Afghanistan">Afghanistan</option>
                                                <option label="Åland Islands" value="Åland Islands">Åland Islands</option>
                                                <option label="Albania" value="Albania">Albania</option>
                                                <option label="Algeria" value="Algeria">Algeria</option>
                                                <option label="AmericanSamoa" value="AmericanSamoa">AmericanSamoa</option>
                                                <option label="Andorra" value="Andorra">Andorra</option>
                                                <option label="Angola" value="Angola">Angola</option>
                                                <option label="Anguilla" value="Anguilla">Anguilla</option>
                                                <option label="Antarctica" value="Antarctica">Antarctica</option>
                                                <option label="Antigua and Barbuda" value="Antigua and Barbuda">Antigua and
                                                    Barbuda</option>
                                                <option label="Argentina" value="Argentina">Argentina</option>
                                                <option label="Armenia" value="Armenia">Armenia</option>
                                                <option label="Aruba" value="Aruba">Aruba</option>
                                                <option label="Australia" value="Australia">Australia</option>
                                                <option label="Austria" value="Austria">Austria</option>
                                                <option label="Azerbaijan" value="Azerbaijan">Azerbaijan</option>
                                                <option label="Bahamas" value="Bahamas">Bahamas</option>
                                                <option label="Bahrain" value="Bahrain">Bahrain</option>
                                                <option label="Bangladesh" value="Bangladesh">Bangladesh</option>
                                                <option label="Barbados" value="Barbados">Barbados</option>
                                                <option label="Belarus" value="Belarus">Belarus</option>
                                                <option label="Belgium" value="Belgium">Belgium</option>
                                                <option label="Belize" value="Belize">Belize</option>
                                                <option label="Benin" value="Benin">Benin</option>
                                                <option label="Bermuda" value="Bermuda">Bermuda</option>
                                                <option label="Bhutan" value="Bhutan">Bhutan</option>
                                                <option label="Bolivia, Plurinational State of"
                                                    value="Bolivia, Plurinational State of">Bolivia,
                                                    Plurinational State of</option>
                                                <option label="Bosnia and Herzegovina" value="Bosnia and Herzegovina">Bosnia
                                                    and
                                                    Herzegovina
                                                </option>
                                                <option label="Botswana" value="Botswana">Botswana</option>
                                                <option label="Brazil" value="Brazil">Brazil</option>
                                                <option label="British Indian Ocean Territory"
                                                    value="British Indian Ocean Territory">British
                                                    Indian Ocean Territory</option>
                                                <option label="Brunei Darussalam" value="Brunei Darussalam">Brunei
                                                    Darussalam
                                                </option>
                                                <option label="Bulgaria" value="Bulgaria">Bulgaria</option>
                                                <option label="Burkina Faso" value="Burkina Faso">Burkina Faso</option>
                                                <option label="Burundi" value="Burundi">Burundi</option>
                                                <option label="Cambodia" value="Cambodia">Cambodia</option>
                                                <option label="Cameroon" value="Cameroon">Cameroon</option>
                                                <option label="Canada" value="Canada">Canada</option>
                                                <option label="Cape Verde" value="Cape Verde">Cape Verde</option>
                                                <option label="Cayman Islands" value="Cayman Islands">Cayman Islands
                                                </option>
                                                <option label="Central African Republic" value="Central African Republic">
                                                    Central African
                                                    Republic</option>
                                                <option label="Chad" value="Chad">Chad</option>
                                                <option label="Chile" value="Chile">Chile</option>
                                                <option label="China" value="China">China</option>
                                                <option label="Christmas Island" value="Christmas Island">Christmas Island
                                                </option>
                                                <option label="Cocos (Keeling) Islands" value="Cocos (Keeling) Islands">
                                                    Cocos
                                                    (Keeling) Islands
                                                </option>
                                                <option label="Colombia" value="Colombia">Colombia</option>
                                                <option label="Comoros" value="Comoros">Comoros</option>
                                                <option label="Congo" value="Congo">Congo</option>
                                                <option label="Congo, The Democratic Republic of the Congo"
                                                    value="Congo, The Democratic Republic of the Congo">Congo, The
                                                    Democratic
                                                    Republic of the
                                                    Congo</option>
                                                <option label="Cook Islands" value="Cook Islands">Cook Islands</option>
                                                <option label="Costa Rica" value="Costa Rica">Costa Rica</option>
                                                <option label="Cote d'Ivoire" value="Cote d'Ivoire">Cote d'Ivoire</option>
                                                <option label="Croatia" value="Croatia">Croatia</option>
                                                <option label="Cuba" value="Cuba">Cuba</option>
                                                <option label="Cyprus" value="Cyprus">Cyprus</option>
                                                <option label="Czech Republic" value="Czech Republic">Czech Republic
                                                </option>
                                                <option label="Denmark" value="Denmark">Denmark</option>
                                                <option label="Djibouti" value="Djibouti">Djibouti</option>
                                                <option label="Dominica" value="Dominica">Dominica</option>
                                                <option label="Dominican Republic" value="Dominican Republic">Dominican
                                                    Republic
                                                </option>
                                                <option label="Ecuador" value="Ecuador">Ecuador</option>
                                                <option label="Egypt" value="Egypt">Egypt</option>
                                                <option label="El Salvador" value="El Salvador">El Salvador</option>
                                                <option label="Equatorial Guinea" value="Equatorial Guinea">Equatorial
                                                    Guinea
                                                </option>
                                                <option label="Eritrea" value="Eritrea">Eritrea</option>
                                                <option label="Estonia" value="Estonia">Estonia</option>
                                                <option label="Ethiopia" value="Ethiopia">Ethiopia</option>
                                                <option label="Falkland Islands (Malvinas)"
                                                    value="Falkland Islands (Malvinas)">
                                                    Falkland Islands
                                                    (Malvinas)</option>
                                                <option label="Faroe Islands" value="Faroe Islands">Faroe Islands</option>
                                                <option label="Fiji" value="Fiji">Fiji</option>
                                                <option label="Finland" value="Finland">Finland</option>
                                                <option label="France" value="France">France</option>
                                                <option label="French Guiana" value="French Guiana">French Guiana</option>
                                                <option label="French Polynesia" value="French Polynesia">French Polynesia
                                                </option>
                                                <option label="Gabon" value="Gabon">Gabon</option>
                                                <option label="Gambia" value="Gambia">Gambia</option>
                                                <option label="Georgia" value="Georgia">Georgia</option>
                                                <option label="Germany" value="Germany">Germany</option>
                                                <option label="Ghana" value="Ghana">Ghana</option>
                                                <option label="Gibraltar" value="Gibraltar">Gibraltar</option>
                                                <option label="Greece" value="Greece">Greece</option>
                                                <option label="Greenland" value="Greenland">Greenland</option>
                                                <option label="Grenada" value="Grenada">Grenada</option>
                                                <option label="Guadeloupe" value="Guadeloupe">Guadeloupe</option>
                                                <option label="Guam" value="Guam">Guam</option>
                                                <option label="Guatemala" value="Guatemala">Guatemala</option>
                                                <option label="Guernsey" value="Guernsey">Guernsey</option>
                                                <option label="Guinea" value="Guinea">Guinea</option>
                                                <option label="Guinea-Bissau" value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option label="Guyana" value="Guyana">Guyana</option>
                                                <option label="Haiti" value="Haiti">Haiti</option>
                                                <option label="Holy See (Vatican City State)"
                                                    value="Holy See (Vatican City State)">Holy See
                                                    (Vatican City State)</option>
                                                <option label="Honduras" value="Honduras">Honduras</option>
                                                <option label="Hong Kong" value="Hong Kong">Hong Kong</option>
                                                <option label="Hungary" value="Hungary">Hungary</option>
                                                <option label="Iceland" value="Iceland">Iceland</option>
                                                <option label="India" value="India">India</option>
                                                <option label="Indonesia" value="Indonesia">Indonesia</option>
                                                <option label="Iran, Islamic Republic of Persian Gulf"
                                                    value="Iran, Islamic Republic of Persian Gulf">Iran, Islamic Republic of
                                                    Persian Gulf</option>
                                                <option label="Iraq" value="Iraq">Iraq</option>
                                                <option label="Ireland" value="Ireland">Ireland</option>
                                                <option label="Isle of Man" value="Isle of Man">Isle of Man</option>
                                                <option label="Israel" value="Israel">Israel</option>
                                                <option label="Italy" value="Italy">Italy</option>
                                                <option label="Jamaica" value="Jamaica">Jamaica</option>
                                                <option label="Japan" value="Japan">Japan</option>
                                                <option label="Jersey" value="Jersey">Jersey</option>
                                                <option label="Jordan" value="Jordan">Jordan</option>
                                                <option label="Kazakhstan" value="Kazakhstan">Kazakhstan</option>
                                                <option label="Kenya" value="Kenya">Kenya</option>
                                                <option label="Kiribati" value="Kiribati">Kiribati</option>
                                                <option label="Korea, Republic of South Korea"
                                                    value="Korea, Republic of South Korea">Korea,
                                                    Republic of South Korea</option>
                                                <option label="Kuwait" value="Kuwait">Kuwait</option>
                                                <option label="Kyrgyzstan" value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option label="Laos" value="Laos">Laos</option>
                                                <option label="Latvia" value="Latvia">Latvia</option>
                                                <option label="Lebanon" value="Lebanon">Lebanon</option>
                                                <option label="Lesotho" value="Lesotho">Lesotho</option>
                                                <option label="Liberia" value="Liberia">Liberia</option>
                                                <option label="Libyan Arab Jamahiriya" value="Libyan Arab Jamahiriya">Libyan
                                                    Arab Jamahiriya
                                                </option>
                                                <option label="Liechtenstein" value="Liechtenstein">Liechtenstein</option>
                                                <option label="Lithuania" value="Lithuania">Lithuania</option>
                                                <option label="Luxembourg" value="Luxembourg">Luxembourg</option>
                                                <option label="Macao" value="Macao">Macao</option>
                                                <option label="Macedonia" value="Macedonia">Macedonia</option>
                                                <option label="Madagascar" value="Madagascar">Madagascar</option>
                                                <option label="Malawi" value="Malawi">Malawi</option>
                                                <option label="Malaysia" value="Malaysia">Malaysia</option>
                                                <option label="Maldives" value="Maldives">Maldives</option>
                                                <option label="Mali" value="Mali">Mali</option>
                                                <option label="Malta" value="Malta">Malta</option>
                                                <option label="Marshall Islands" value="Marshall Islands">Marshall Islands
                                                </option>
                                                <option label="Martinique" value="Martinique">Martinique</option>
                                                <option label="Mauritania" value="Mauritania">Mauritania</option>
                                                <option label="Mauritius" value="Mauritius">Mauritius</option>
                                                <option label="Mayotte" value="Mayotte">Mayotte</option>
                                                <option label="Mexico" value="Mexico">Mexico</option>
                                                <option label="Micronesia, Federated States of Micronesia"
                                                    value="Micronesia, Federated States of Micronesia">Micronesia, Federated
                                                    States of Micronesia
                                                </option>
                                                <option label="Moldova" value="Moldova">Moldova</option>
                                                <option label="Monaco" value="Monaco">Monaco</option>
                                                <option label="Mongolia" value="Mongolia">Mongolia</option>
                                                <option label="Montenegro" value="Montenegro">Montenegro</option>
                                                <option label="Montserrat" value="Montserrat">Montserrat</option>
                                                <option label="Morocco" value="Morocco">Morocco</option>
                                                <option label="Mozambique" value="Mozambique">Mozambique</option>
                                                <option label="Myanmar" value="Myanmar">Myanmar</option>
                                                <option label="Namibia" value="Namibia">Namibia</option>
                                                <option label="Nauru" value="Nauru">Nauru</option>
                                                <option label="Nepal" value="Nepal">Nepal</option>
                                                <option label="Netherlands" value="Netherlands">Netherlands</option>
                                                <option label="Netherlands Antilles" value="Netherlands Antilles">
                                                    Netherlands
                                                    Antilles</option>
                                                <option label="New Caledonia" value="New Caledonia">New Caledonia</option>
                                                <option label="New Zealand" value="New Zealand">New Zealand</option>
                                                <option label="Nicaragua" value="Nicaragua">Nicaragua</option>
                                                <option label="Niger" value="Niger">Niger</option>
                                                <option label="Nigeria" value="Nigeria">Nigeria</option>
                                                <option label="Niue" value="Niue">Niue</option>
                                                <option label="Norfolk Island" value="Norfolk Island">Norfolk Island
                                                </option>
                                                <option label="Northern Mariana Islands" value="Northern Mariana Islands">
                                                    Northern Mariana
                                                    Islands</option>
                                                <option label="Norway" value="Norway">Norway</option>
                                                <option label="Oman" value="Oman">Oman</option>
                                                <option label="Pakistan" value="Pakistan">Pakistan</option>
                                                <option label="Palau" value="Palau">Palau</option>
                                                <option label="Palestinian Territory, Occupied"
                                                    value="Palestinian Territory, Occupied">
                                                    Palestinian Territory, Occupied</option>
                                                <option label="Panama" value="Panama">Panama</option>
                                                <option label="Papua New Guinea" value="Papua New Guinea">Papua New Guinea
                                                </option>
                                                <option label="Paraguay" value="Paraguay">Paraguay</option>
                                                <option label="Peru" value="Peru">Peru</option>
                                                <option label="Philippines" value="Philippines">Philippines</option>
                                                <option label="Pitcairn" value="Pitcairn">Pitcairn</option>
                                                <option label="Poland" value="Poland">Poland</option>
                                                <option label="Portugal" value="Portugal">Portugal</option>
                                                <option label="Puerto Rico" value="Puerto Rico">Puerto Rico</option>
                                                <option label="Qatar" value="Qatar">Qatar</option>
                                                <option label="Romania" value="Romania">Romania</option>
                                                <option label="Russia" value="Russia">Russia</option>
                                                <option label="Rwanda" value="Rwanda">Rwanda</option>
                                                <option label="Reunion" value="Reunion">Reunion</option>
                                                <option label="Saint Barthelemy" value="Saint Barthelemy">Saint Barthelemy
                                                </option>
                                                <option label="Saint Helena, Ascension and Tristan Da Cunha"
                                                    value="Saint Helena, Ascension and Tristan Da Cunha">Saint Helena,
                                                    Ascension
                                                    and Tristan Da
                                                    Cunha</option>
                                                <option label="Saint Kitts and Nevis" value="Saint Kitts and Nevis">Saint
                                                    Kitts
                                                    and Nevis
                                                </option>
                                                <option label="Saint Lucia" value="Saint Lucia">Saint Lucia</option>
                                                <option label="Saint Martin" value="Saint Martin">Saint Martin</option>
                                                <option label="Saint Pierre and Miquelon" value="Saint Pierre and Miquelon">
                                                    Saint Pierre and
                                                    Miquelon</option>
                                                <option label="Saint Vincent and the Grenadines"
                                                    value="Saint Vincent and the Grenadines">Saint
                                                    Vincent and the Grenadines</option>
                                                <option label="Samoa" value="Samoa">Samoa</option>
                                                <option label="San Marino" value="San Marino">San Marino</option>
                                                <option label="Sao Tome and Principe" value="Sao Tome and Principe">Sao Tome
                                                    and
                                                    Principe
                                                </option>
                                                <option label="Saudi Arabia" value="Saudi Arabia">Saudi Arabia</option>
                                                <option label="Senegal" value="Senegal">Senegal</option>
                                                <option label="Serbia" value="Serbia">Serbia</option>
                                                <option label="Seychelles" value="Seychelles">Seychelles</option>
                                                <option label="Sierra Leone" value="Sierra Leone">Sierra Leone</option>
                                                <option label="Singapore" value="Singapore">Singapore</option>
                                                <option label="Slovakia" value="Slovakia">Slovakia</option>
                                                <option label="Slovenia" value="Slovenia">Slovenia</option>
                                                <option label="Solomon Islands" value="Solomon Islands">Solomon Islands
                                                </option>
                                                <option label="Somalia" value="Somalia">Somalia</option>
                                                <option label="South Africa" value="South Africa">South Africa</option>
                                                <option label="South Georgia and the South Sandwich Islands"
                                                    value="South Georgia and the South Sandwich Islands">South Georgia and
                                                    the
                                                    South Sandwich
                                                    Islands</option>
                                                <option label="Spain" value="Spain">Spain</option>
                                                <option label="Sri Lanka" value="Sri Lanka">Sri Lanka</option>
                                                <option label="Sudan" value="Sudan">Sudan</option>
                                                <option label="Suriname" value="Suriname">Suriname</option>
                                                <option label="Svalbard and Jan Mayen" value="Svalbard and Jan Mayen">
                                                    Svalbard
                                                    and Jan Mayen
                                                </option>
                                                <option label="Swaziland" value="Swaziland">Swaziland</option>
                                                <option label="Sweden" value="Sweden">Sweden</option>
                                                <option label="Switzerland" value="Switzerland">Switzerland</option>
                                                <option label="Syrian Arab Republic" value="Syrian Arab Republic">Syrian
                                                    Arab
                                                    Republic</option>
                                                <option label="Taiwan" value="Taiwan">Taiwan</option>
                                                <option label="Tajikistan" value="Tajikistan">Tajikistan</option>
                                                <option label="Tanzania, United Republic of Tanzania"
                                                    value="Tanzania, United Republic of Tanzania">Tanzania, United Republic
                                                    of
                                                    Tanzania</option>
                                                <option label="Thailand" value="Thailand">Thailand</option>
                                                <option label="Timor-Leste" value="Timor-Leste">Timor-Leste</option>
                                                <option label="Togo" value="Togo">Togo</option>
                                                <option label="Tokelau" value="Tokelau">Tokelau</option>
                                                <option label="Tonga" value="Tonga">Tonga</option>
                                                <option label="Trinidad and Tobago" value="Trinidad and Tobago">Trinidad and
                                                    Tobago</option>
                                                <option label="Tunisia" value="Tunisia">Tunisia</option>
                                                <option label="Turkey" value="Turkey">Turkey</option>
                                                <option label="Turkmenistan" value="Turkmenistan">Turkmenistan</option>
                                                <option label="Turks and Caicos Islands" value="Turks and Caicos Islands">
                                                    Turks
                                                    and Caicos
                                                    Islands</option>
                                                <option label="Tuvalu" value="Tuvalu">Tuvalu</option>
                                                <option label="Uganda" value="Uganda">Uganda</option>
                                                <option label="Ukraine" value="Ukraine">Ukraine</option>
                                                <option label="United Arab Emirates" value="United Arab Emirates">United
                                                    Arab
                                                    Emirates</option>
                                                <option label="United Kingdom" value="United Kingdom">United Kingdom
                                                </option>
                                                <option label="United States" value="United States">United States</option>
                                                <option label="Uruguay" value="Uruguay">Uruguay</option>
                                                <option label="Uzbekistan" value="Uzbekistan">Uzbekistan</option>
                                                <option label="Vanuatu" value="Vanuatu">Vanuatu</option>
                                                <option label="Venezuela, Bolivarian Republic of Venezuela"
                                                    value="Venezuela, Bolivarian Republic of Venezuela">Venezuela,
                                                    Bolivarian
                                                    Republic of
                                                    Venezuela</option>
                                                <option label="Vietnam" value="Vietnam">Vietnam</option>
                                                <option label="Virgin Islands, British" value="Virgin Islands, British">
                                                    Virgin
                                                    Islands, British
                                                </option>
                                                <option label="Virgin Islands, U.S." value="Virgin Islands, U.S.">Virgin
                                                    Islands, U.S.</option>
                                                <option label="Wallis and Futuna" value="Wallis and Futuna">Wallis and
                                                    Futuna
                                                </option>
                                                <option label="Yemen" value="Yemen">Yemen</option>
                                                <option label="Zambia" value="Zambia">Zambia</option>
                                                <option label="Zimbabwe" value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="company">Company Name</label>
                                            <input type="text" class="form-control" id="company"
                                                placeholder="Enter Your Company Name" name="companyname"
                                                value="{{ auth()->user()->companyname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="timezone">Time Zone</label>
                                            <input type="text" class="form-control" id="timezone"
                                                placeholder="Enter Your Time Zone" name="timezone"
                                                value="{{ auth()->user()->timezone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold" for="location">Location</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="location"
                                                    placeholder="Enter Your Location" name="location"
                                                    value="{{ auth()->user()->location }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary">
                                                        <i class="fa fa-map-marker"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">Mobile Phone Number</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="number">Mobile Phone Number:</label>
                                            <span class="font-size-sm ml-2">+923487991015</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="country2">Country:</label>
                                            <span class="font-size-sm ml-2">{{ auth()->user()->country }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-wide" value="Submit" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" >
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url(./img/dashboard/banner-1.jpg);">
                            <h1 class="h5 font-weight-bold text-white">Notification Setting</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Notification</h2>

                            <hr>

                            <h6 class="font-weight-bold pb-2">Email</h6>
                            <form action="{{ route('/setting/email') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Your Email Address"
                                                value="{{ auth()->user()->email }}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 align-self-end">
                                        <div class="form-group">
                                            <input type="submit" value="Update Email Address" class="btn btn-secondary"
                                                name="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <h6 class="font-weight-bold pb-2">I want to receive new projects, contests, and service
                                employment news by email</h6>
                            <p class="font-size-sm">With this feature, you will receive notifications and you will be
                                notified of project, contest, and service adoption emails through various activities such
                                as:</p>
                            <ul class="text-info py-4">
                                <li>If a freelancer supports the project</li>
                                <li>If the freelancer approves the project</li>
                                <li>When a freelancer requests payment</li>
                                <li>When a freelancer submits to a contest</li>
                                <li>When a client creates a deposit</li>
                                <li>If the client pays the deposit</li>
                                <li>When evaluating project completion work</li>
                            </ul>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch1">If the
                                    amount of the project is canceled or renewed</label>
                            </div>

                            <hr>

                            <h6 class="font-weight-bold pb-2">Project notifications that match your expertise</h6>
                            <p class="font-size-sm">When you use this feature, you will be notified of all projects that
                                match your expertise.</p>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch2">Notify
                                    me when my project is registered</label>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" >
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url(./img/dashboard/banner-1.jpg);">
                            <h1 class="h5 font-weight-bold text-white">Password Change</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Change Password</h2>

                            <hr>
                            <form action="{{ route('/setting/password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="font-size-ms" for="cPassword">Current Password</label>
                                    <input type="password" class="form-control" id="cPassword"
                                        placeholder="Enter Your Current Password" name="current_password">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-size-ms" for="nPassword">New Password</label>
                                    <input type="password" class="form-control" id="nPassword"
                                        placeholder="Enter Your New Password" name="new_password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-size-ms" for="rcPassword">ReConfirm Password</label>
                                    <input type="password" class="form-control" id="rcPassword"
                                        placeholder="Enter Your New Password" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" value="Change Password" name="submit" class="btn btn-primary px-4">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" >
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url(./img/dashboard/banner-1.jpg);">
                            <h1 class="h5 font-weight-bold text-white">Account setting</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Account</h2>

                            <hr>
                            <form action="{{ route('/setting/account') }}" method="post">
                                @csrf
                                <h6 class="font-weight-bold pb-2">Setting up a freelance list</h6>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                    <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch3">I
                                        want
                                        to be registered on the freelance list so that I can hire myself for the project
                                        work.</label>
                                </div>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                                    <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch4">I
                                        want
                                        to be notified to all freelancers after registration of project, contest,
                                        service.</label>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">Select Amount</h6>
                                <p class="font-size-sm">If you want to change your account:</p>

                                <div class="pt-4">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '3' ? 'checked' : '' }} value="3">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline1">Freelancer</label>
                                    </div>
                                    {{ auth()->user()->usertype == '2' ? 'checked' : '' }}
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '2' ? 'checked' : '' }} value="2">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline2">Client</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" value="Set up" class="btn btn-primary btn-wide">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
