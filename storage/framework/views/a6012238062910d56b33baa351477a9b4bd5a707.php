<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>Pencil Sketch</title>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">Image Upload and Convert to Pencil Sketch</h2>
            <div class="row">
                <div class="col-6">
                    <form action="<?php echo e(route('upload.submit')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <label class="fw-bold pt-3 pb-3" for="image">Upload Image</label>
                        <input type="file" name="image" class="form-control" />
                        <div class="pt-3">
                            <button class="btn btn-success" type="submit">Upload Image</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="pb-4">
                <?php if($message = Session::get('success')): ?>
                <p class="pt-3 pb-3 fw-bold"><?php echo e($message); ?></p>
                <div>
                    <?php if($imageName = Session::get('imageName')): ?>
                    <div class="pb-2">
                        <h1>Uploaded Image</h1>
                        <img src="<?php echo e(asset('images/'.$imageName)); ?>" alt="Uploaded Image" height="200px" width="300px"/>
                    </div>
                    <div>
                        <h1>Pencil Sketch</h1>
                        <img src="<?php echo e(asset('images/sketch_'.$imageName)); ?>" alt="Pencil Sketch" height="200px" width="300px"/>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\pencil_sketch\resources\views/home.blade.php ENDPATH**/ ?>