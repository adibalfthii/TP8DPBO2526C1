<?php include 'view/header.php'; ?>

<div class="row">
    <!-- Form Tambah / Edit Department -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header <?= $editData ? 'bg-warning text-dark' : 'bg-primary text-white' ?>">
                <h5 class="mb-0"><?= $editData ? 'Edit Department' : 'Create Department' ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=departments">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="department_name" class="form-control" value="<?= htmlspecialchars($editData['department_name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Faculty</label>
                        <input type="text" name="faculty" class="form-control" value="<?= htmlspecialchars($editData['faculty'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $editData ? 'Update Department' : 'Submit' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="index.php?page=departments" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Departments -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Departments List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>Faculty</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['department_name']) ?></td>
                                <td><?= htmlspecialchars($row['faculty']) ?></td>
                                <td>
                                    <a href="index.php?page=departments&action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=departments&action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this department?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'view/footer.php'; ?>