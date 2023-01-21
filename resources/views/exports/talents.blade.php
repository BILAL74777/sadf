    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
    </head>
    <body>

        <table>
            
            
            <tbody>
                @if ($Talent->is_adult == 'No')

                <tr>
                    <td>
                        Parent Information
                    </td>  
                </tr>
                <tr></tr>
                    
                <tr>
                    <th>Parent First Name</th>
                    <th>Parent Last Name</th>
                    <th>Type of document of identity</th>
                    <th>Identification Document</th>
                    <th>Date Of Birth</th>
                    <th>Nationality</th>
                    <th>Gender</th>
                    <th>Bloog Group</th>
                    <th>Parent Catastrophic Illness</th>
                    <th>Specify</th>
                    <th>Prent Allergies</th>
                    <th>Which Allergy</th>
                    <th>Diet</th> 
                </tr>

                <tr>
                    <td>{{ $Talent->parent_first_name }}</td>
                    <td>{{ $Talent->parent_last_name }}</td>
                    <td>{{ $Talent->parent_type_of_document_of_identity }}</td>
                    <td>{{ $Talent->parent_dob }}</td>
                    <td>{{ $Talent->parent_nationality }}</td>
                    <td>{{ $Talent->parent_gender }}</td>
                    <td>{{ $Talent->parent_blood_group }}</td>
                    <td>{{ $Talent->parent_catastrophic_illness }}</td>
                    <td>{{ $Talent->parent_catastrophic_illness_specify }}</td>
                    <td>{{ $Talent->parent_have_allergies }}</td>
                    <td>{{ $Talent->parent_have_which_allergies }}</td>
                    <td>{{ $Talent->parent_diet }}</td> 
                </tr>

                @endif

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        <h2>Personal Information</h2>
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Type of document of identity</td>
                    <td>Identification Document</td>
                    <td>Date Of Birth</td>
                    <td>Nationality</td>
                    <td>Do you consider yourself</td>
                    <td>Gender</td>
                    <td>Special ability</td>
                    <td>Which</td>
                     
                </tr>

                <tr>
                    <td>{{ $Talent->first_name }}</td>
                    <td>{{ $Talent->last_name }}</td>
                    <td>{{ $Talent->type_of_document_of_identity }}</td>
                    <td>{{ $Talent->identification_document }}</td>
                    <td>{{ $Talent->dob }}</td>
                    <td>{{ $Talent->talent_nationality }}</td>
                    <td>{{ $Talent->do_you_consider_yourself }}</td>
                    <td>{{ $Talent->gender }}</td>
                    <td>{{ $Talent->do_you_have_any_special_ability }}</td>
                    <td>{{ $Talent->do_you_have_any_special_ability_which }}</td>
                    <td>{{ $Talent->do_you_have_any_special_ability_specify }}</td>
                     
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        Contact Information
                    </td>  
                </tr>
                <tr></tr>
                
                <tr>
                    <td>Cell Phone</td>
                    <td>Local Number</td>
                    <td>Auxiliry Number</td>
                    <td>Email</td>
                    <td>Facebook</td>
                    <td>instagram</td>
                    <td>Tiktok</td>
                    <td>Have Agency</td>
                    <td>Specified Agency</td>
                </tr>

                <tr>
                    <td>{{ $Talent->cell_phone }}</td>
                    <td>{{ $Talent->local_number }}</td>
                    <td>{{ $Talent->auxiliry_number }}</td>
                    <td>{{ $Talent->email }}</td>
                    <td>{{ $Talent->facebook }}</td>
                    <td>{{ $Talent->instagram }}</td>
                    <td>{{ $Talent->tiktok }}</td>
                    <td>{{ $Talent->you_have_agency }}</td>
                    <td>{{ $Talent->you_have_agency_specify }}</td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        Look
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>Hair Color  </td>
                    <td>Hair</td>
                    <td>Hair Cut</td>
                    <td>Hair Lighter</td>
                    <td>Natural</td>
                    <td>Hair Lenght</td>
                    <td>Hair Type</td>
                    <td>Eyes Color</td>
                    <td>Fringe</td>
                    <td>Is Bracket</td>
                    <td>Has Beard</td>
                    <td>Skin Color</td>
                </tr>
                <tr>
                    <td>{{ $Talent->hair_color }}</td>
                    <td>{{ $Talent->hair }}</td>
                    <td>{{ $Talent->hair_cut }}</td>
                    <td>{{ $Talent->hair_lighter }}</td>
                    <td>{{ $Talent->naturals }}</td>
                    <td>{{ $Talent->hair_lenght }}</td>
                    <td>{{ $Talent->hair_type }}</td>
                    <td>{{ $Talent->eyes_color }}</td>
                    <td>{{ $Talent->fringe }}</td>
                    <td>{{ $Talent->has_brackets }}</td>
                    <td>{{ $Talent->has_beard }}</td>
                    <td>{{ $Talent->skin_color }}</td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                       Sizes
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>Height</td>
                    <td>Shirt Size</td>
                    <td>Pant Size</td>
                    <td>Shoes Size</td>
                </tr>
                <tr>
                    <td>{{ $Talent->height }}</td>
                    <td>{{ $Talent->shirt_size }}</td>
                    <td>{{ $Talent->pant_size }}</td>
                    <td>{{ $Talent->shoes_size }}</td>
                     
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td>
                        Capabilities
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>Drive motorcycle</td>
                    <td>Has License</td>
                    <td> Drive Car</td>
                    <td>Manual Drive</td>
                    <td>Types of motorcycle</td>
                    <td>Prictice Sports</td>
                    <td>Which Sports</td>
                    <td>You are an actor or actress</td>
                    <td>You are a Singer</td>
                    <td>You are a Musician</td>
                    <td>Instrument do you play</td>
                    <td>Dance Prictice</td>
                    <td>Which Prictice</td>
                    <td>Accents</td>
                    <td>Specify Accents</td>
                    <td>Languages</td>
                    <td>Specify Languages</td>
                </tr>

                <tr>
                    <td>{{ $Talent->drive_motorcycle }}</td>
                    <td>{{ $Talent->has_license }}</td>
                    <td>{{ $Talent->drive_car }}</td>
                    <td>{{ $Talent->manual_drives }}</td>
                    <td>{{ $Talent->motorcycle_type }}</td>
                    <td>{{ $Talent->prictice_sport }}</td>
                    <td>{{ $Talent->which_sport }}</td>
                    <td>{{ $Talent->actor_or_actress }}</td>
                    <td>{{ $Talent->musician }}</td>
                    <td>{{ $Talent->instrument }}</td>
                    <td>{{ $Talent->dance_prictice }}</td>
                    <td>{{ $Talent->which_dance_prictice }}</td>
                    <td>{{ $Talent->accent }}</td>
                    <td>{{ $Talent->specify_accent }}</td>
                    <td>{{ $Talent->languages }}</td>
                    <td>{{ $Talent->specify_langauges }}</td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        Controles
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>The Color of the Hair whould be changed</td>
                    <td>Comment</td>
                    <td>The Color of the Hair whould be Cut</td>
                    <td>Comment</td>
                    <td>Tattoos</td>
                    <td>How Many Tattoos</td>
                    <td>It Has Piercing</td>
                    <td>Comment</td>
                </tr>

                <tr>
                    <td>{{ $Talent->hair_color_whoul_be_changed }}</td>
                    <td>{{ $Talent->comment_hair_color_whoul_be_changed }}</td>
                    <td>{{ $Talent->hair_whoul_be_cut }}</td>
                    <td>{{ $Talent->comment_hair_whoul_be_cut }}</td>
                    <td>{{ $Talent->tattoos }}</td>
                    <td>{{ $Talent->how_many_tattoos }}</td>
                    <td>{{ $Talent->it_has_piercing }}</td>
                    <td>{{ $Talent->comment_it_has_piercing }}</td>
                     
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        Rights
                    </td>  
                </tr>
                <tr></tr>

                <tr>
                    <td>You have done commercials</td>
                    <td>industy</td>
                </tr>
                <tr>
                    <td>{{ $Talent->done_commercials }}</td>
                    <td>{{ $Talent->industy }}</td> 
                </tr>


                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>
                        Body
                    </td>  
                </tr>

                <tr>
                    <th>Body</th>  
                    <th>ID</th>  
                    <th>Home Telephone</th>  
                    <th>cellular</th>  
                    <th>Has whatsapp</th>  
                    <th>City Of Residence</th>  
                    <th>Country Of Origin</th>  
                    <th>Address</th>  
                    <th>Location</th>  
                    <th>Bank Account</th>  
                    <th>Number Type OF Account Holder</th>  
                    <th>Is Out Of City</th>  
                    <th>Return Date</th>  
                    <th>Is Out Of Country</th>  
                    <th>Return Date</th>  
                    <th>Withdrawal Date</th>  
                    <th>Has Nails</th>  
                    <th>Color</th>  
                    <th>Have cars</th>  
                    <th>How Many Cars</th>  
                    <th>Places</th>  
                    <th>Marks</th>  
                    <th>Long</th>  
                    <th>Rights</th>  
                    <th>Have Desease</th>  
                    <th>Which desease</th>  
                    <th>Have Allergies</th>  
                    <th>Which Allergies</th>  
                    <th>Diet</th>  
                    <th>Blood Group</th>  
                    <th>Sporting Activities</th>  
                </tr>
                <tr>
                    <td>{{ $Talent->body }}</td> 
                    <td>{{ $Talent->id_number }}</td> 
                    <td>{{ $Talent->home_telephone }}</td> 
                    <td>{{ $Talent->cellular }}</td> 
                    <td>{{ $Talent->has_whatsapp }}</td> 
                    <td>{{ $Talent->city_of_residence }}</td> 
                    <td>{{ $Talent->country_of_origin }}</td> 
                    <td>{{ $Talent->address }}</td> 
                    <td>{{ $Talent->location }}</td> 
                    <td>{{ $Talent->bank_account }}</td> 
                    <td>{{ $Talent->number_type_of_account_holder }}</td> 
                    <td>{{ $Talent->is_out_of_the_city }}</td> 
                    <td>{{ $Talent->city_date_of_return }}</td> 
                    <td>{{ $Talent->is_out_of_the_country }}</td> 
                    <td>{{ $Talent->country_date_of_return }}</td> 
                    <td>{{ $Talent->date_of_withdrawal_of_brackets }}</td> 
                    <td>{{ $Talent->has_nails }}</td> 
                    <td>{{ $Talent->color }}</td> 
                    <td>{{ $Talent->have_cars }}</td> 
                    <td>{{ $Talent->how_many_cars }}</td> 
                    <td>{{ $Talent->places }}</td> 
                    <td>{{ $Talent->mark }}</td> 
                    <td>{{ $Talent->long_ }}</td> 
                    <td>{{ $Talent->rights }}</td> 
                    <td>{{ $Talent->have_desease }}</td> 
                    <td>{{ $Talent->which_desease }}</td> 
                    <td>{{ $Talent->have_allergies }}</td> 
                    <td>{{ $Talent->which_allergies }}</td> 
                    <td>{{ $Talent->diet }}</td> 
                    <td>{{ $Talent->blood_group }}</td> 
                    <td>{{ $Talent->sporting_activities }}</td> 
                      
                </tr>
           
            </tbody>
        </table>
        
        
    </body>
    </html>