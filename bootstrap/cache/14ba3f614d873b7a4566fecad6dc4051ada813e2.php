<?php $__env->startSection('title', 'Product Categories'); ?>
<?php $__env->startSection('data-page-id', 'adminCategories'); ?>

<?php $__env->startSection('content'); ?>
    <div class="category">
        <div class="row expanded column" >
            <h2>Product Categories</h2>  
        </div>

        <?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row expanded">
            <div class="small-12 medium-6 column">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="input-group-field" placeholder="Search by name">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Search">
                        </div>
                    </div>
                </form> 
            </div>

            <div class="small-12 medium-5 column end">
                <form action="/admin/product/categories" method="post" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="input-group-field" name="name" placeholder="Category name">
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Create category">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row expanded">
            <div class="small-12 medium-11 column">
                <?php if(count($categories)): ?>
                    <table class="hover" data-form="deleteForm">
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($category['name']); ?></td>
                                    <td><?php echo e($category['slug']); ?></td>
                                    <td><?php echo e($category['added']); ?></td>
                                    <td width="100" class="text-right admin-categories-actions"> 
                                        <span data-tooltip tabindex="1" title="Add Sub-category" class="has-tip top">
                                            <a data-open="add-subcategory-<?php echo e($category['id']); ?>"><i class="fa fa-plus" ></i></a>
                                        </span>       
                                        <span data-tooltip tabindex="1" title="Edit Category" class="has-tip top">
                                            <a data-open="item-<?php echo e($category['id']); ?>"><i class="fa fa-edit" ></i></a>
                                        </span>
                                        <span style="display: inline-block" data-tooltip tabindex="1" title="Delete Category" class="has-tip top">
                                           <form action="/admin/product/categories/<?php echo e($category['id']); ?>/delete" method="POST" class="delete-item" >
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                           </form>
                                        </span> 

                                        
                                        <div class="reveal" id="item-<?php echo e($category['id']); ?>" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit Category</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <input type="text"  name="name" value="<?php echo e($category['name']); ?>">
                                                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                                    <div>
                                                        <input type="submit" class="button update-category" id="<?php echo e($category['id']); ?>" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>

                                        
                                        <div class="reveal" id="add-subcategory-<?php echo e($category['id']); ?>" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Add Subcategory</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <input type="text"  name="name"> 
                                                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">

                                                    <div>
                                                        <input type="submit" class="button add-subcategory" id="<?php echo e($category['id']); ?>" value="Add Sub-category">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php echo $links; ?>

                <?php else: ?>
                    <h3>No Categories created</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="subcategory">
        <div class="row expanded column" >
            <h2>Subcategories</h2>  
        </div>    

        <div class="row expanded">
            <div class="small-12 medium-11 column">
                <?php if(count($subcategories)): ?>
                    <table class="hover" data-form="deleteForm">
                        <tbody>
                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($subcategory['name']); ?></td>
                                    <td><?php echo e($subcategory['slug']); ?></td>
                                    <td><?php echo e($subcategory['added']); ?></td>
                                    <td width="100" class="text-right admin-categories-actions"> 
                                             
                                        <span data-tooltip tabindex="1" title="Edit Subcategory" class="has-tip top">
                                            <a data-open="item-subcategory-<?php echo e($subcategory['id']); ?>"><i class="fa fa-edit" ></i></a>
                                        </span>
                                        <span style="display: inline-block" data-tooltip tabindex="1" title="Delete Subcategory" class="has-tip top">
                                           <form action="/admin/product/subcategories/<?php echo e($subcategory['id']); ?>/delete" method="POST" class="delete-item" >
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                           </form>
                                        </span> 

                                        
                                        <div class="reveal" id="item-subcategory-<?php echo e($subcategory['id']); ?>" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit Subcategory</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <input type="text"  name="name" value="<?php echo e($subcategory['name']); ?>">
                                                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                                    <div>
                                                        <input type="submit" class="button update-category" id="<?php echo e($subcategory['id']); ?>" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php echo $subcategories_links; ?>

                <?php else: ?>
                    <h2>No Subcategories created</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php echo $__env->make('includes.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kaloy/sites/ecommerce/resources/views/admin/products/categories.blade.php ENDPATH**/ ?>