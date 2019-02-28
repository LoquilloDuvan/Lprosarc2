<?php $__env->startSection('htmlheader_title','Asistencia'); ?>

<?php $__env->startSection('contentheader_title', 'Asistencia'); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Asistencia del personal</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <table id="AssistancesTable1" class="table table-compact table-bordered table-striped">
                <thead>
                  <tr>
  	                <th>Nombre</th>
    	              <th>Hora Llegada</th>
                    <th>Trabajando</th>
    	              <th>Hora Salida</th>
                  </tr>
                </thead>
                <tbody  hidden onload="renderTable()" id="readyTable">
                  
                  <div class="fingerprint-spinner" id="loadingTable">
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                    <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                  </div>
                    <?php $__currentLoopData = $Asistencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Asistencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($Asistencia->PersFirstName." ".$Asistencia->PersLastName); ?></td>
                      <td><?php echo e($Asistencia->AsisLlegada); ?></td>
                      <?php if($Asistencia->AsisStatus == 0): ?>
                        <td>No</td>
                      <?php else: ?>
                        <td>Si</td>
                      <?php endif; ?>
                      <td><?php echo e($Asistencia->AsisSalida); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>