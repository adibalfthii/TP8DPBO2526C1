<?php include 'view/header.php'; ?>

<div class="row">
    <!-- Form Tambah / Edit Lecturer -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header <?= $editData ? 'bg-warning text-dark' : 'bg-primary text-white' ?>">
                <h5 class="mb-0"><?= $editData ? 'Edit Lecturer' : 'Create Lecturer' ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=lecturers">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($editData['name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIDN</label>
                        <input type="text" name="nidn" class="form-control" value="<?= htmlspecialchars($editData['nidn'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($editData['phone'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Join Date</label>
                        <input type="date" name="join_date" class="form-control" value="<?= $editData['join_date'] ?? '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select" required>
                            <option value="">-- Select Department --</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= (isset($editData['department_id']) && $editData['department_id'] == $dept['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dept['department_name']) ?> (<?= htmlspecialchars($dept['faculty']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $editData ? 'Update Lecturer' : 'Submit' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="index.php?page=lecturers" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Lecturers -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Lecturers List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NIDN</th>
                            <th>Phone</th>
                            <th>Join Date</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lecturers as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['nidn']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= $row['join_date'] ?></td>
                                <td><?= htmlspecialchars($row['department_name']) ?></td>
                                <td>
                                    <a href="index.php?page=lecturers&action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=lecturers&action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this lecturer?')">Delete</a>
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