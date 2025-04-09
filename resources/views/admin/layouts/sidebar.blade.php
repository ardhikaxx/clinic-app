<div class="bg-light border-right vh-100" id="sidebar-wrapper" style="width: 250px;">
    <div class="sidebar-heading bg-primary text-white py-3">
        <i class="fas fa-clinic-medical me-2"></i>Klinik Sehat
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
        
        <a href="{{ route('admin.patients.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-user-injured me-2"></i>Pasien
        </a>
        
        <a href="{{ route('admin.registrations.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-clipboard-list me-2"></i>Pendaftaran
        </a>
        
        <div class="list-group-item list-group-item-action dropdown-toggle" data-bs-toggle="collapse" href="#examinationMenu">
            <i class="fas fa-stethoscope me-2"></i>Pemeriksaan
        </div>
        <div class="collapse" id="examinationMenu">
            <a href="{{ route('admin.examinations.general.index') }}" class="list-group-item list-group-item-action ps-5">
                <i class="fas fa-user-md me-2"></i>Poli Umum
            </a>
            <a href="{{ route('admin.examinations.kia.index') }}" class="list-group-item list-group-item-action ps-5">
                <i class="fas fa-baby me-2"></i>Poli KIA
            </a>
            <a href="{{ route('admin.examinations.inpatient.index') }}" class="list-group-item list-group-item-action ps-5">
                <i class="fas fa-procedures me-2"></i>Rawat Inap
            </a>
            <a href="{{ route('admin.examinations.emergency.index') }}" class="list-group-item list-group-item-action ps-5">
                <i class="fas fa-ambulance me-2"></i>UGD
            </a>
        </div>
        
        <a href="{{ route('admin.pharmacy.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-pills me-2"></i>Farmasi
        </a>
        
        <a href="{{ route('admin.payments.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-money-bill-wave me-2"></i>Pembayaran
        </a>
        
        <a href="{{ route('admin.medical-records.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-file-medical me-2"></i>Rekam Medis
        </a>
        
        <a href="{{ route('admin.reports.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-chart-bar me-2"></i>Laporan
        </a>
    </div>
</div>