<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .cancel-button {
            padding: 0.5rem 1rem;
            background-color: #e5e7eb;
            color: #374151;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .confirm-button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .delete-info {
            background: #fff5f5;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .delete-info p {
            margin: 0.5rem 0;
        }

        .warning-text {
            color: rgb(131, 1, 1);
            font-weight: bold;
            margin: 1rem 0;
            padding: 1rem;
            background: #fff5f5;
            border-radius: 0.5rem;
            border: 1px solid #dc2626;
        }

        .warning-text ul {
            margin-left: 2rem;
        }

        .delete-confirmation {
            margin-top: 1rem;
        }

        .delete-confirmation input {
            width: 100%;
            padding: 0.5rem;
            border: 2px solid #dc2626;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .delete-btn {
            background: #dc2626;
            color: white;
        }

        .delete-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Delete My Account</h3>
                <button type="button" class="close-modal" onclick="closeDeleteModal()">&times;</button>
            </div>
            <form id="deleteModalForm" method="POST" action="/Free-Write/public/User/DeleteUser">
                <div class="warning-text">
                    ⚠️ WARNING: This action is irreversible!
                    <ul>
                        <li>All user content will be permanently removed from the database</li>
                        <li>This includes all posts, comments, and uploaded content</li>
                        <li>User's account access will be immediately terminated</li>
                        <li>This action cannot be undone</li>
                    </ul>
                </div>

                <div class="delete-confirmation">
                    <label>
                        <strong>To confirm deletion, type your password: *</strong>
                        <input type="password" id="deleteConfirmText" name="deleteConfirmText"
                            oninput="validateDeleteConfirmation()" placeholder="Last time to enter your password">
                    </label>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="cancel-button" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm-button delete-btn" id="deleteSubmitBtn" disabled>Delete
                        User</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>