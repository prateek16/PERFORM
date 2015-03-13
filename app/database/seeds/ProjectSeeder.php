<?php

class ProjectSeeder extends Seeder {

    public function run()
    {
        //DB::table('projects')->delete();
        DB::table('users')->delete();
        // DB::table('project_user')->delete();




        DB::table('themes')->delete();
        DB::table('categories')->delete();
        DB::table('kpis')->delete();
        DB::table('markers')->delete();
      //  DB::table('roles')->delete();
       // DB::table('targets')->delete();
      //  DB::table('returns')->delete();
        // DB::table('kpi_project')->delete();
        //  DB::table('officer')->delete();
        //  DB::table('manager')->delete();

         $user1 =  User::create(array(
             'id' => 1,
             'firstName' => 'Prateek ',
             'lastName' => 'Singh',
             'email' => 'admin@admin.com',
             'password' => Hash::make('asdf123'),
             'role' => 'manager',
             'level' => 'A',
             'contact' => '0116 224 2247',
             'address' => 'Ayleston Road, Leicester, LE2 7LW'

         ));

//        $user2 =  User::create(array(
//            'id' => 2,
//            'firstName' => 'Officer ',
//            'lastName' => 'officer',
//            'email' => 'off@off.com',
//            'password' => Hash::make('asdf123'),
//            'role' => 'officer',
//            'level' => 'H',
//            'contact' => '',
//            'address' => ''
//
//        ));

        //   $officer1 = Officer::create(array(
        //     'id' => 1,
        //     'user_id' => 2
        //     ));

        //    $manager1 = Manager::create(array(
        //     'id' => 1,
        //     'user_id' => 1
        //     ));

        // $this->command->info('Users are Live!');


        // $p1 = Project::create(array(
        //     'id' => '1',
        //     'name' => 'Web Development',
        //     'description' => 'Web development testing...'


        // ));

        //   $p2 = Project::create(array(
        //     'id' => '2',
        //     'name' => 'App Development',
        //     'description' => 'App development testing...'


        // ));

        //      $p3 =  Project::create(array(
        //         'id' => '3',

        //     'name' => 'Leicester College Expansion for Skills',
        //     'description' => 'Leicester College is expanding its facilities to provide new opportunities to develop local skills in priority
        //     sectors for the LLEP.
        //     Especially in engineering amd sustainable construction. This expansion supports the development of the Leicester Launchpad.'

        // ));

        // $this->command->info('Projects are Live!');



        // $kp1 = keyPartner::create(array(
        //     'id' => 1,
        //     'name' => 'LCC',
        //     'firstname' => 'Prateek Singh',
        //     'Project_id' => '1',
        //     'email' => 'admin@admin.com',
        //     'Contact' => '0116 224 2247',
        //     'Address' => 'Ayleston Road, Leicester, LE2 7LW'

        // ));

        //    $kp2 = keyPartner::create(array(
        //      'id' => 2,
        //     'name' => 'XYZ',
        //     'firstname' => 'Prateek Singh',
        //     'Project_id' => '1',
        //     'email' => 'admin@admin.com',
        //     'Contact' => '0116 224 2247',
        //     'Address' => 'Ayleston Road, Leicester, LE2 7LW'

        // ));

        //     $this->command->info('keyPartners are Live!');


        //     $st1 = stakeHolder::create(array(
        //      'id' => 1,
        //     'name' => 'LCC',
        //     'firstname' => 'Prateek Singh',
        //     'Project_id' => '1',
        //     'email' => 'admin@admin.com',
        //     'Contact' => '0116 224 2247',
        //     'Address' => 'Ayleston Road, Leicester, LE2 7LW'

        // ));

        //    $st2 = stakeHolder::create(array(
        //      'id' => 2,
        //     'name' => 'XYZ',
        //     'firstname' => 'Prateek Singh',
        //     'Project_id' => '1',
        //     'email' => 'admin@admin.com',
        //     'Contact' => '0116 224 2247',
        //     'Address' => 'Ayleston Road, Leicester, LE2 7LW'

        // ));

        //     $this->command->info('stakeHolders are Live!');


        $setting = Marker::create(array(
            'red' => '20',
            'green' => '11',
            'pink' => '11',
            'orange' => '0'
        ));


///////////////////                                        Roles                          //////////////////////////////////////
///
///

        $role1 = Role::create(array(
            'role' => 'Programme Manager',
            'level' => 'A'));

        $role2 = Role::create(array(
            'role' => 'Programme Director',
            'level' => 'B'));

        $role3 = Role::create(array(
            'role' => 'Other LEP/LA staff',
            'level' => 'C'));
        $role4 = Role::create(array(
            'role' => 'LEP/LA Board',
            'level' => 'D'));
        $role5 = Role::create(array(
            'role' => 'LA Councillors',
            'level' => 'E'));
        $role6 = Role::create(array(
            'role' => 'Partner Organisations',
            'level' => 'F'));
        $role7 = Role::create(array(
            'role' => 'Project Manager',
            'level' => 'G'));
        $role8 = Role::create(array(
            'role' => 'Project Officer',
            'level' => 'H'));
        $role9 = Role::create(array(
            'role' => 'Project other staff',
            'level' => 'I'));
        $role10 = Role::create(array(
            'role' => 'Local media',
            'level' => 'J'));
        $role11 = Role::create(array(
            'role' => 'Citizens',
            'level' => 'K'));

///////////////////                                         Category ends                           //////////////////////////////////////
///
///
///
///
///

        $th1 = Theme::create(array(
            'id' => '1',
            'name' => 'Innovation & RTD',
            'code' => '11'
        ));
        $th2 = Theme::create(array(
            'id' => '2',
            'name' => 'IT services and infrastructure',
            'code' => '12'
        ));
        $th3 = Theme::create(array(
            'id' => '3',
            'name' => 'Other SME and Business support',
            'code' => '13'
        ));
        $th4 = Theme::create(array(
            'id' => '4',
            'name' => 'Energy',
            'code' => '14'
        ));
        $th5 = Theme::create(array(
            'id' => '5',
            'name' => 'Environment',
            'code' => '15'
        ));
        $th6 = Theme::create(array(
            'id' => '6',
            'name' => 'Culture, heritage and tourism',
            'code' => '16'
        ));
        $th7 = Theme::create(array(
            'id' => '7',
            'name' => 'Urban and territorial dimension',
            'code' => '17'
        ));
        $th8 = Theme::create(array(
            'id' => '8',
            'name' => 'Rail',
            'code' => '18'
        ));
        $th9 = Theme::create(array(
            'id' => '9',
            'name' => 'Road',
            'code' => '19'
        ));
        $th10 = Theme::create(array(
            'id' => '10',
            'name' => 'Other transport',
            'code' => '20'
        ));
        $th11 = Theme::create(array(
            'id' => '11',
            'name' => 'Labour market',
            'code' => '21'
        ));
        $th12 = Theme::create(array(
            'id' => '12',
            'name' => 'Social Inclusion',
            'code' => '22'
        ));
        $th13 = Theme::create(array(
            'id' => '13',
            'name' => 'Social infrastructure',
            'code' => '23'
        ));
        $th14 = Theme::create(array(
            'id' => '14',
            'name' => 'Human capital',
            'code' => '24'
        ));
        $th15 = Theme::create(array(
            'id' => '15',
            'name' => 'Capacity Building',
            'code' => '25'
        ));

        $th53 = Theme::create(array(
            'id' => '18',
            'name' => 'Homes',
            'code' => '26'
        ));

        $th73 = Theme::create(array(
            'id' => '19',
            'name' => 'Colleges',
            'code' => '27'
        ));

        $th0 = Theme::create(array(
            'id' => '16',
            'name' => 'Funding',
            'code' => '00'
        ));

        $th099 = Theme::create(array(
            'id' => '17',
            'name' => 'Spending',
            'code' => '00'
        ));


        $this->command->info('Themes are Live!');
        ///////////////////                                         Theme ends                           //////////////////////////////////////
///
///

///////////////////                                         Categories                           //////////////////////////////////////
///
///


        $cat1 = Category::create(array(
            'id' => '1',
            'name' => 'R&TD activities in research centres',
            'code' => '01',
            'theme_id' => '1'

        ));
        $cat2 = Category::create(array(
            'id' => '2',
            'name' => 'R&TD infrastructure and centres of competence in a specific technology',
            'code' => '02',
            'theme_id' => '1'

        ));
        $cat3 = Category::create(array(
            'id' => '3',
            'name' => 'Technology transfer and improvement of cooperation networks',
            'code' => '03',
            'theme_id' => '1'

        ));
        $cat4 = Category::create(array(
            'id' => '4',
            'name' => 'Assistance to R&TD, particularly in SMEs (including access to R&TD services in research centres)',
            'code' => '04',
            'theme_id' => '1'

        ));
        $cat5 = Category::create(array(
            'id' => '5',
            'name' => 'Assistance to SMEs for the promotion of environmentally-friendly products and production processes',
            'code' => '06',
            'theme_id' => '1'

        ));
        $cat8 = Category::create(array(
            'id' => '6',
            'name' => 'Investment in firms directly linked to research and innovation',
            'code' => '07',
            'theme_id' => '1'

        ));
        $cat6 = Category::create(array(
            'id' => '7',
            'name' => 'Other measures to stimulate research and innovation and entrepreneurship in SMEs',
            'code' => '9',
            'theme_id' => '1'

        ));
        $cat7 = Category::create(array(
            'id' => '8',
            'name' => 'Developing human potential in the field of research and innovation, in particular through post-graduate studies',
            'code' => '74',
            'theme_id' => '1'

        ));

        $cat53 = Category::create(array(
            'id' => '101',
            'name' => 'Household',
            'code' => '101',
            'theme_id' => '18'

        ));

        $cat73 = Category::create(array(
            'id' => '102',
            'name' => 'Students...',
            'code' => '102',
            'theme_id' => '19'

        ));


        $cat0 = Category::create(array(
            'id' => '999',
            'name' => 'Funding',
            'code' => '00',
            'theme_id' => '16'

        ));


        $cat099 = Category::create(array(
            'id' => '1000',
            'name' => 'Spending',
            'code' => '00',
            'theme_id' => '17'

        ));


        $this->command->info('Categories are Live!');


///////////////////                                         Category ends                           //////////////////////////////////////
///
///
///
///
///


        $kpi1 = KPI::create(array(
            'id' => '1',
            'name' => 'Number of new centres developed',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Place"
        ));

        $kpi2 = KPI::create(array(
            'id' => '2',
            'name' => 'Sq.m. of new centres developed',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Place"
        ));

        $kpi3 = KPI::create(array(
            'id' => '3',
            'name' => 'Number of existing centres enhanced',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Place"
        ));

        $kpi4 = KPI::create(array(
            'id' => '4',
            'name' => 'Sq. m. of existing centres enhanced',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Place"
        ));

        ///    5

        $kpi6 = KPI::create(array(
            'id' => '6',
            'name' => 'Value of technical equipment purchased in new or enhanced centre',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'currency' => '1'
        ));



        $kpi7 = KPI::create(array(
            'id' => '7',
            'name' => 'Number of construction jobs supported',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1'
        ));

        $kpi8 = KPI::create(array(
            'id' => '8',
            'name' => 'Number of businesses supported by new or enhanced centre',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Business"
        ));

        $kpi9 = KPI::create(array(
            'id' => '9',
            'name' => 'Number of employees in businesses assisted',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "People"
        ));

        $kpi10 = KPI::create(array(
            'id' => '10',
            'name' => 'Number of employees in businesses start-ups',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "People"
        ));

        /////    5, 11, 12

        $kpi13 = KPI::create(array(
            'id' => '13',
            'name' => 'Number of new business start-ups supported',
            'description' => '',
            'category_id' => '1',
            'theme_id' => '1',
            'type' => "Business"
        ));


        $kpi53 = KPI::create(array(
            'id' => '16',
            'name' => 'Households protected.',
            'description' => '',
            'category_id' => '101',
            'theme_id' => '18',
            'type' => "Place"
        ));

        $kpi54 = KPI::create(array(
            'id' => '17',
            'name' => 'Homes built.',
            'description' => '',
            'category_id' => '101',
            'theme_id' => '18',
            'type' => "Place"
        ));

        $kpi73 = KPI::create(array(
            'id' => '18',
            'name' => 'Students enrolling on courses.',
            'description' => '',
            'category_id' => '102',
            'theme_id' => '19',
            'type' => "People"
        ));

        $kpi74 = KPI::create(array(
            'id' => '19',
            'name' => 'Students successfully completing courses.',
            'description' => '',
            'category_id' => '102',
            'theme_id' => '19',
            'type' => "People"
        ));









        $kpi0 = KPI::create(array(
            'id' => '14',
            'name' => 'Funding',
            'description' => '',
            'category_id' => '999',
            'theme_id' => '16',
            'currency' => '1'

        ));

        $kpi099 = KPI::create(array(
            'id' => '15',
            'name' => 'Spending',
            'description' => '',
            'category_id' => '1000',
            'theme_id' => '17',
            'currency' => '1'

        ));



        $this->command->info('KPIs are Live!');

        ///////////////////                                         KPI ends                           //////////////////////////////////////
///
///

        // $return1 = Returns::create(array(
        //    'id' => '1',

        //        'user' => '1',
        //        'type' => 'target',
        //        'Project_id' => '1',
        //        'record' => 'quarter'
        //        ));

        //  $return2 = Returns::create(array(
        //    'id' => '2',

        //        'user' => '1',
        //        'type' => 'target',
        //        'Project_id' => '1',
        //        'record' => 'month'
        //        ));

        //   $return3 = Returns::create(array(
        //    'id' => '3',

        //        'user' => '1',
        //        'type' => 'target',
        //        'Project_id' => '1',
        //        'record' => 'quarter'
        //        ));

        // $kpit1 = KPIT::create(array(
        //        'kpi_id' => '1',
        //       'value' => '20',
        //       'target' => '30',
        //       'return_id' => '1'
        //       ));

        //  $kpit2 = KPIT::create(array(
        //        'kpi_id' => '5',
        //       'value' => '50',
        //       'target' => '40',
        //       'return_id' => '2'
        //       ));



        // $p1->users()->attach($user1->id);
        // $p2->users()->attach($user1->id);
        // $p3->users()->attach($user2->id);





        //$manager1->officers()->attach($officer1->id);

        $this->command->info('Attachments are Live!');
    }

}