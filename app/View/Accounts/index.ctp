<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-pushpin"></i>
                    <h3>Accounts</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
            
                
                <h2>All Accounts</h2>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Add', 
                    array('controller' => 'accounts', 'action' => 'create'), 
                    array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php if(isset($accounts) && !empty($accounts)): ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Facility </th>
                    <th> Username </th>
                    <th> Type </th>
                    <th> Status </th>
                    <th> Last login date </th>
                    <th class="td-actions" width="17%"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($accounts as $account): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> <?php echo $account['MedicalFacility']['name'];?> </td>
                    <td> <?php echo $account['Account']['username'];?> </td>
                    <td> <?php echo $account['AccountType']['name'];?> </td>
                    <td> 
                        <?php if($account['Account']['active'] == '1'): $active = 1; ?>
                            <span class="label label-success">Active</span>
                        <?php else: $active = 0; ?>
                            <span class="label label-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td> <?php echo $account['Account']['updated'];?> </td>
                    <td class="td-actions">
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
                                array('controller' => 'accounts', 'action' => 'view', $account['Account']['id']),
                                array('class' => 'btn btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'accounts', 'action' => 'edit', $account['Account']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
                                array('controller' => 'accounts', 'action' => 'delete', $account['Account']['id']),
                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Delete'));?>
                        <?php 
                            if($active == 1):
                                echo $this->Html->link('<i class="btn-icon-only icon-lock"></i>',
                                        array('controller' => 'accounts', 'action' => 'deactivate', $account['Account']['id']),
                                        array('class' => 'btn btn-small btn-warning', 'escape' => false,
                                            'data-toggle' => 'tooltip', 'title' => 'Deactivate'));
                            else:
                                echo $this->Html->link('<i class="btn-icon-only icon-unlock"></i>',
                                        array('controller' => 'accounts', 'action' => 'activate', $account['Account']['id']),
                                        array('class' => 'btn btn-small btn-warning', 'escape' => false,
                                            'data-toggle' => 'tooltip', 'title' => 'Activate'));
                            endif;
                        ?> 
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>No Account recorded</p>
                <?php endif; ?>
                </div> <!-- /widget-content -->
            </div> <!-- /widget -->			
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
           
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>