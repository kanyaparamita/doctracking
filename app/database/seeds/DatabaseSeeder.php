<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('OrganizationTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('UnitTableSeeder');
		$this->call('PositionTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('TypeInputSeeder');
		$this->call('TypeOutputSeeder');
		$this->call('ServiceSeeder');
		$this->call('ServiceRequirementSeeder');
		$this->call('BaseProcessSeeder');

	}

}

class OrganizationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('organizations')->delete();

        Organization::create(array('id' => 1,
        						   'name' => 'Badan Penanaman Modal Daerah dan Pelayanan Terpadu Satu Pintu',
        						   'nick' => 'BPM-PTSP',
        						   'email' => 'bpmdptsp_payakumbuh@yahoo.co.id',
        						   'phone' => '(0752)94474',
        						   'website' => 'www.kppt-kotapayakumbuh.org',
        						   'address' => 'Jl. Jambu Kompl.Pasar Ibuh Kota Payakumbuh'
        						   ));
    }

}

class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        Role::create(array('id' => 7,
						   'name' => 'Loket',
						   'description' => ''
						   ));

        Role::create(array('id' => 2,
						   'name' => 'Tim Analis',
						   'description' => ''
						   ));

        Role::create(array('id' => 3,
						   'name' => 'Surveyor',
						   'description' => ''
						   ));

        Role::create(array('id' => 4,
						   'name' => 'Komite Pemberi Izin',
						   'description' => ''
						   ));

        Role::create(array('id' => 5,
						   'name' => 'Pemberi Izin',
						   'description' => ''
						   ));


        Role::create(array('id' => 6,
						   'name' => 'Keuangan',
						   'description' => ''
						   ));

        Role::create(array('id' => 1,
						   'name' => 'Administrator',
						   'description' => ''
						   ));
    }

}

class PositionTableSeeder extends Seeder {

	public function run() {
		DB::table('positions')->delete();

		Position::create(array(
				'id' => 1,
				'organization_id' => 1,
				'name' => 'Kepala',
				'description' => 'Kepala'
			));

		Position::create(array(
				'id' => 2,
				'organization_id' => 1,
				'name' => 'Sekretaris',
				'description' => 'Sekretaris Kepala'
			));

		Position::create(array(
				'id' => 3,
				'organization_id' => 1,
				'name' => 'Kabid',
				'description' => 'Kepala Bidang'
			));

		Position::create(array(
				'id' => 4,
				'organization_id' => 1,
				'name' => 'Kasubbag',
				'description' => 'Kepala Sub Bagian'
			));

		Position::create(array(
				'id' => 5,
				'organization_id' => 1,
				'name' => 'Anggota',
				'description' => 'Anggota yang levelnya berada di dalam naungan sebuah unit'
			));
	}
}

class UnitTableSeeder extends Seeder {

	public function run() {
		DB::table('units')->delete();

		Unit::create(array(
			'id' => 1,
			'organization_id' => 1,
			'name' => 'High Rank Unit',
			));

		Unit::create(array(
			'id' => 2,
			'organization_id' => 1,
			'name' => 'Bidang Kendali Program',
			));

		Unit::create(array(
			'id' => 3,
			'organization_id' => 1,
			'name' => 'Bidang Penanaman Modal',
			));

		Unit::create(array(
			'id' => 4,
			'organization_id' => 1,
			'name' => 'Bidang Pelayanan',
			));

		Unit::create(array(
			'id' => 5,
			'organization_id' => 1,
			'name' => 'Bidang Promosi, Informasi dan Pengawasan Permodalan',
			));

		Unit::create(array(
			'id' => 6,
			'organization_id' => 1,
			'name' => 'Bagian Keuangan',
			));

		Unit::create(array(
			'id' => 7,
			'organization_id' => 1,
			'name' => 'Bagian Umum dan Perlengkapan',
			));

		Unit::create(array(
			'id' => 8,
			'organization_id' => 1,
			'name' => 'Bagian Kepegawaian',
			));

		Unit::create(array(
			'id' => 9,
			'organization_id' => 1,
			'name' => 'Bagian Perencanaan dan Penetapan',
			));

		Unit::create(array(
			'id' => 10,
			'organization_id' => 1,
			'name' => 'Bagian Evaluasi dan Pelaporan',
			));

		Unit::create(array(
			'id' => 11,
			'organization_id' => 1,
			'name' => 'Bagian Penanaman Modal',
			));

		Unit::create(array(
			'id' => 12,
			'organization_id' => 1,
			'name' => 'Bagian Kerjasama',
			));

		Unit::create(array(
			'id' => 13,
			'organization_id' => 1,
			'name' => 'Bagian Pengawasan Permodalan',
			));

		Unit::create(array(
			'id' => 14,
			'organization_id' => 1,
			'name' => 'Bagian Promosi dan Informasi',
			));
	}
}

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		User::create(array('name' => 'Elzadaswarman SKM, MPPM',
						   'username' => 'elzadaswarman',
						   'password' =>  Hash::make('elzadaswarman'),
						   'role_id' => '1',
						   'organization_id' => '1',
						   'unit_id' => '1',
						   'position_id' => '1'
							));

		User::create(array('name' => 'Loket',
						   'username' => 'loket',
						   'password' =>  Hash::make('loket'),
						   'role_id' => '7',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));

		User::create(array('name' => 'Tim Analis',
						   'username' => 'timanalis',
						   'password' =>  Hash::make('timanalis'),
						   'role_id' => '2',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));

		User::create(array('name' => 'Surveyor',
						   'username' => 'surveyor',
						   'password' =>  Hash::make('surveyor'),
						   'role_id' => '3',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));

		User::create(array('name' => 'Komite Pemberi Izin',
						   'username' => 'kpi',
						   'password' =>  Hash::make('kpi'),
						   'role_id' => '4',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));

		User::create(array('name' => 'Pemberi Izin',
						   'username' => 'pi',
						   'password' =>  Hash::make('pi'),
						   'role_id' => '5',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));

		User::create(array('name' => 'Keuangan',
						   'username' => 'keuangan',
						   'password' =>  Hash::make('keuangan'),
						   'role_id' => '6',
						   'organization_id' => '1',
						   'unit_id' => '3',
						   'position_id' => '5'
							));
		// User::create(array('name' => 'Drs. Irwandi Darmawan',
		// 				   'username' => 'irwandi',
		// 				   'password' =>  Hash::make('irwandi'),
		// 				   'role_id' => '2',
		// 				   'organization_id' => '1',
		// 				   'unit_id' => '2',
		// 				   'position_id' => '3'
		// 					));

		// User::create(array('name' => 'Mediawarman, SE',
		// 				   'username' => 'mediawarman',
		// 				   'password' =>  Hash::make('mediawarman'),
		// 				   'role_id' => '2',
		// 				   'organization_id' => '1',
		// 				   'unit_id' => '3',
		// 				   'position_id' => '3'
		// 					));

		// User::create(array('firstName' => 'Drs. Harmansyah, APT, MM',
		// 				   'lastName' => '',
		// 				   'username' => 'harmansyah',
		// 				   'password' =>  Hash::make('harmansyah'),
		// 				   'role_id' => '2',
		// 				   'organization_id' => '1',
		// 				   'unit_id' => '4',
		// 				   'position_id' => '3'
		// 					));

		// User::create(array('firstName' => 'Ir. Yansawalis',
		// 				   'lastName' => '',
		// 				   'username' => 'yansawalis',
		// 				   'password' =>  Hash::make('yansawalis'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '5',
		// 				   'position_id' => '3'
		// 					));

		// User::create(array('firstName' => 'Friza Susanti, SE',
		// 				   'lastName' => '',
		// 				   'username' => 'friza',
		// 				   'password' =>  Hash::make('friza'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '6',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Yumaizar',
		// 				   'lastName' => '',
		// 				   'username' => 'yumaizar',
		// 				   'password' =>  Hash::make('yumaizar'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '7',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Mailis',
		// 				   'lastName' => '',
		// 				   'username' => 'mailis',
		// 				   'password' =>  Hash::make('mailis'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '8',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Ezy',
		// 				   'lastName' => 'Elfiwati, SE',
		// 				   'username' => 'ezy',
		// 				   'password' =>  Hash::make('ezy'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '9',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Reni',
		// 				   'lastName' => 'Dewita, SH',
		// 				   'username' => 'reni',
		// 				   'password' =>  Hash::make('reni'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '10',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Ike',
		// 				   'lastName' => 'Santika, SH',
		// 				   'username' => 'ike',
		// 				   'password' =>  Hash::make('ike'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '11',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'M. Saat, BBA',
		// 				   'lastName' => '',
		// 				   'username' => 'yumaizar',
		// 				   'password' =>  Hash::make('yumaizar'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '12',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Drs. Agus Tri Susatya, MPA',
		// 				   'lastName' => '',
		// 				   'username' => 'agus',
		// 				   'password' =>  Hash::make('agus'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '13',
		// 				   'position_id' => '4'
		// 					));

		// User::create(array('firstName' => 'Wenty',
		// 				   'lastName' => 'Zahrati, S.Kom, M.Kom',
		// 				   'username' => 'wenty',
		// 				   'password' =>  Hash::make('wenty'),
		// 				   'role_id' => '2',
		// 				   // 'organization_id' => '1',
		// 				   'unit_id' => '14',
		// 				   'position_id' => '4'
		// 					));
	}
}

class TypeInputSeeder extends Seeder {
	public function run()
    {
        DB::table('type_input')->delete();

        TypeInput::create(array('id' => 1,
        						   'name' => 'Static Text',
        						   'value' => 'text',
        						   'description' => 'Static text berupa kalimat, tidak ada interaksi'
        						   ));

        TypeInput::create(array('id' => 2,
        						   'name' => 'Text',
        						   'value' => 'input',
        						   'description' => 'Berupa input text'
        						   ));

        TypeInput::create(array('id' => 3,
        						   'name' => 'File',
        						   'value' => 'file',
        						   'description' => 'Berupa input file untuk upload, hanya jpeg/pdf'
        						   ));
    }
}

class TypeOutputSeeder extends Seeder {
	public function run()
    {
        DB::table('type_output')->delete();

        TypeOutput::create(array('id' => 1,
        						   'name' => 'PDF',
        						   'value' => 'application/pdf',
        						   'description' => 'View file pdf'
        						   ));

        TypeOutput::create(array('id' => 2,
        						   'name' => 'Image',
        						   'value' => 'image/jpeg',
        						   'description' => 'View file image'
        						   ));

        TypeOutput::create(array('id' => 3,
        						   'name' => 'Text',
        						   'value' => 'text/plain',
        						   'description' => 'View text'
        						   ));
    }
}

class ServiceSeeder extends Seeder {
	public function run()
    {
        DB::table('services')->delete();

        Service::create(array('id' => 1,
        						   'name' => 'Pembuatan Surat Izin Tempat Usaha (SITU / HO) ',
        						   'category' => 1, // sementara 1 untuk layanan
        						   'estimated_days' => 7,
        						   'organization_id' => 1
        						   ));
    }
}

class ServiceRequirementSeeder extends Seeder {
	public function run()
    {
        DB::table('type_output')->delete();

        ServiceRequirement::create(array('id' => 1,
        						   'service_id' => 1,
        						   'name' => 'Surat Izin Mendirikan Bangunan dan Sertifikat / Kontrak sewa',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 2,
        						   'service_id' => 1,
        						   'name' => 'Tanda Lunas PBB Th. 2000',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 3,
        						   'service_id' => 1,
        						   'name' => 'Kartu Tanda Penduduk',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 4,
        						   'service_id' => 1,
        						   'name' => 'Denah Lokasi Tempat Usaha',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 5,
        						   'service_id' => 1,
        						   'name' => 'Surat Pernyataan Tidak Keberatan Tetangga (diketahui oleh Lurah)',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 6,
        						   'service_id' => 1,
        						   'name' => 'Akte Pendirian / Notaris',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 7,
        						   'service_id' => 1,
        						   'name' => 'Surat Penunjukan/surat kuasa/ surat keputusan dari usaha induk/pusat (*khusus usaha yang merupakan anak cabang usaha)',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 8,
        						   'service_id' => 1,
        						   'name' => 'Persyaratan lainnya apabila diperlukan/Dokumen pembantu lain (hasil cek labor, BPOM, purna jual dll untuk usaha klasifikasi tertentu)',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 9,
        						   'service_id' => 1,
        						   'name' => 'Foto Pengaju',
        						   'type' => 3
        						   ));

        ServiceRequirement::create(array('id' => 10,
        						   'service_id' => 1,
        						   'name' => 'Nama',
        						   'type' => 2
        						   ));

        ServiceRequirement::create(array('id' => 11,
        						   'service_id' => 1,
        						   'name' => 'HP',
        						   'type' => 2
        						   ));

        ServiceRequirement::create(array('id' => 12,
        						   'service_id' => 1,
        						   'name' => 'Email',
        						   'type' => 2
        						   ));
    }
}

class BaseProcessSeeder extends Seeder {
	public function run()
    {
        DB::table('base_process')->delete();
        DB::table('base_process_output')->delete();

        BaseProcess::create(array('id' => 1,
        						   'service_id' => 1,
        						   'next_bp_id' => 2,
        						   'name' => 'Pemeriksaan Dokumen Persyaratan',
        						   'display_text' => 'Pemeriksaan Dokumen Persyaratan',
        						   'roles' => '7',
        						   'is_start' => 1,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 1,
        						   'unit_id' => 3,
        						   'is_display' => 1

        						   ));

        BaseProcess::create(array('id' => 2,
        						   'service_id' => 1,
        						   'next_bp_id' => '3;4',
        						   'name' => 'Desk Validation',
        						   'description' => 'Mengisi daftar pemenuhan persyaratan',
        						   'display_text' => '',
        						   'roles' => '2',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 0,
        						   'pre_con_bp' => '1'
        						   ));

        BaseProcessOutput::create(array('id' => 1,
        							'bp_id' => 2,
        							'name' => 'List Persyaratan',
        							'type' => 3
        							));

        BaseProcess::create(array('id' => 3,
        						   'service_id' => 1,
        						   'next_bp_id' => 5,
        						   'name' => 'Validasi Keuangan',
        						   'display_text' => 'Validasi Keuangan',
        						   'roles' => '2',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '2'
        						   ));

        BaseProcessOutput::create(array('id' => 3,
        							'bp_id' => 3,
        							'name' => 'Detail Validasi Keuangan',
        							'type' => 3
        							));

        BaseProcessOutput::create(array('id' => 4,
        							'bp_id' => 3,
        							'name' => 'Status Validasi Keuangan',
        							'type' => 2
        							));

        BaseProcess::create(array('id' => 4,
        						   'service_id' => 1,
        						   'next_bp_id' => 5,
        						   'name' => 'Validasi Kelayakan Pemberian Izin',
        						   'display_text' => 'Validasi Kelayakan Pemberian Izin',
        						   'roles' => '2',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '2'
        						   ));

        BaseProcessOutput::create(array('id' => 5,
        							'bp_id' => 4,
        							'name' => 'Status Validasi Kelayakan Pemberian Izin',
        							'type' => 2
        							));

        BaseProcess::create(array('id' => 5,
        						   'service_id' => 1,
        						   'next_bp_id' => 6,
        						   'name' => 'Peninjauan Lapangan',
        						   'display_text' => 'Peninjauan Lapangan',
        						   'roles' => '3',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '4'
        						   ));

        BaseProcessOutput::create(array('id' => 6,
        							'bp_id' => 5,
        							'name' => 'Detail Peninjauan Lapangan',
        							'type' => 3
        							));

        BaseProcessOutput::create(array('id' => 7,
        							'bp_id' => 5,
        							'name' => 'Status Peninjauan Lapangan',
        							'type' => 2
        							));

        BaseProcess::create(array('id' => 6,
        						   'service_id' => 1,
        						   'next_bp_id' => 7,
        						   'name' => 'Pembahasan Komite',
        						   'display_text' => 'Pembahasan Hasil Validasi',
        						   'roles' => '4',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 1,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '5'
        						   ));

        BaseProcessOutput::create(array('id' => 8,
        							'bp_id' => 6,
        							'name' => 'Hasil Pembahasan Komite',
        							'type' => 2
        							));

        BaseProcess::create(array('id' => 7,
        						   'service_id' => 1,
        						   'next_bp_id' => 8,
        						   'name' => 'Penerbitan Surat Izin',
        						   'display_text' => 'Penerbitan Surat Izin',
        						   'description' => 'Membuat form pembayaran (sistem generated)',
        						   'roles' => '2',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '6'
        						   ));

        BaseProcessOutput::create(array('id' => 9,
        							'bp_id' => 7,
        							'name' => 'Form Pembayaran',
        							'type' => 3
        							));

        BaseProcess::create(array('id' => 8,
        						   'service_id' => 1,
        						   'next_bp_id' => 9,
        						   'name' => 'Pengecekan Pembayaran',
        						   'display_text' => 'Status Pembayaran',
        						   'roles' => '6',
        						   'is_start' => 0,
        						   'is_finish' => 0,
        						   'is_checkpoint' => 1,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '7'
        						   ));

        BaseProcess::create(array('id' => 9,
        						   'service_id' => 1,
        						   'next_bp_id' => '',
        						   'name' => 'Pengambilan Izin',
        						   'display_text' => 'Status Pengambilan',
        						   'roles' => '7',
        						   'is_start' => 0,
        						   'is_finish' => 1,
        						   'is_checkpoint' => 0,
        						   'unit_id' => 3,
        						   'is_display' => 1,
        						   'pre_con_bp' => '8'

        						   ));
    }
}