<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation History</title>
    <style>
        .message-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .publisher-message {
            background-color: #f0f0f0;
            margin-left: 50px;
        }
        .writer-message {
            background-color: #e0f0ff;
            margin-right: 50px;
        }
        .message-header {
            font-size: 0.8em;
            color: #666;
            margin-bottom: 5px;
        }
        .message-content {
            white-space: pre-wrap;
        }
        .reply-form {
            margin-top: 20px;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .message-actions {
    float: right;
}

.edit-btn, .delete-btn {
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    font-size: 0.8em;
    margin-left: 5px;
}

.edit-btn:hover, .delete-btn:hover {
    text-decoration: underline;
    color: #333;
}

.edit-form textarea {
    width: 100%;
    min-height: 80px;
    margin-bottom: 10px;
    padding: 5px;
}

.edit-form button {
    padding: 5px 10px;
    margin-right: 5px;
}
    </style>
</head>
<body>
    <?php require_once "../app/views/layout/header-pub.php"; ?>
    
    <div class="message-container">
        <h1>Quotation History with <?= htmlspecialchars($writerName); ?></h1>
        
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $index => $message): ?>
    <div class="message <?= $message['sender_type'] == 'publisher' ? 'publisher-message' : 'writer-message'; ?>">
        <div class="message-header">
            <?= htmlspecialchars($message['sender_name']); ?> - <?= htmlspecialchars($message['timestamp']); ?>
            
            <?php if ($message['sender_type'] == 'publisher'): ?>
                <div class="message-actions">
                    <button class="edit-btn" data-message-index="<?= $index; ?>">Edit</button>
                    <button onclick="confirmDelete(<?= $index; ?>)">Delete</button>
                </div>
            <?php endif; ?>
        </div>
        <div class="message-content" id="message-content-<?= $index; ?>">
            <?= htmlspecialchars($message['content']); ?>
        </div>
        
        <div class="edit-form" id="edit-form-<?= $index; ?>" style="display: none;">
            <form action="/Free-Write/public/Publisher/editQuotationMessage" method="post">
            <input type="hidden" name="quotation_id" value="<?= isset($quotationHistory) && isset($quotationHistory['quotaID']) ? htmlspecialchars($quotationHistory['quotaID']) : ''; ?>">
                <input type="hidden" name="message_index" value="<?= $index; ?>">
                <input type="hidden" name="writer_id" value="<?= htmlspecialchars($writerId); ?>">
                <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookId); ?>">
                <textarea name="edited_message"><?= htmlspecialchars($message['content']); ?></textarea>
                <div>
                    <button type="button" class="cancel-edit-btn" data-message-index="<?= $index; ?>">Cancel</button>
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
        
        <div class="reply-form">
            <h2>Send a Reply</h2>
            <form action="/Free-Write/public/Publisher/sendQuotation2Wri" method="post">
                <input type="hidden" name="writer_id" value="<?= htmlspecialchars($writerId); ?>">
                <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookId); ?>">
                
                <textarea name="message" placeholder="Type your message here..." required></textarea>
                
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <script>
    // Edit message functionality
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const messageIndex = this.getAttribute('data-message-index');
            document.getElementById(`message-content-${messageIndex}`).style.display = 'none';
            document.getElementById(`edit-form-${messageIndex}`).style.display = 'block';
        });
    });
    
    // Cancel edit
    document.querySelectorAll('.cancel-edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const messageIndex = this.getAttribute('data-message-index');
            document.getElementById(`message-content-${messageIndex}`).style.display = 'block';
            document.getElementById(`edit-form-${messageIndex}`).style.display = 'none';
        });
    });
    
    // Delete message confirmation
    function confirmDelete(index) {
        if (confirm('Are you sure you want to delete this message?')) {
            // Debug: Add a console log to see if this function is being called
            console.log("Deleting message at index: " + index);
            
            // Use a direct URL construction instead of PHP variables in JavaScript
            window.location.href = '/Free-Write/public/Publisher/deleteQuotationMessage' + 
                '?quotation_id=<?= isset($quotationHistory["quotaID"]) ? htmlspecialchars($quotationHistory["quotaID"]) : ""; ?>' + 
                '&message_index=' + index + 
                '&writer_id=<?= htmlspecialchars($writerId); ?>' + 
                '&book_id=<?= htmlspecialchars($bookId); ?>';
        }
    }
</script>
    
    <?php require_once "../app/views/layout/footer.php"; ?>
</body>
</html>
