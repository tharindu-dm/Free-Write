<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation History</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FCFAF5;
            color: #1C160C;
            line-height: 1.6;
            margin: 0;
        }

        /* Quotation Container */
        .message-container {
            display: flex;
            max-width: 1600px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            height: 1000px;
        }

        /* Chat List */
        /* .chat-list {
            width: 250px;
            background: #fff;
            border-right: 1px solid #ccc;
        }

        .chat-list-header {
            background: #FFD052;
            color: #1C160C;
            padding: 10px;
            font-weight: bold;
            text-align: center;
        } */

        /* .chat-user {
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        } */

        /* Chat Area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
        }

        .chat-header {
            background: #FFD052;
            color: #1C160C;
            padding: 10px;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .chat-messages {
            padding: 15px;
            height: 800px;
            overflow-y: auto;
            background: #f9f9f9;
        }

        /* Message Styling */
        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border-left: 3px solid #FFD052;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.3s;
        }

        .message:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .publisher-message {
            margin-left: 50px;
            border-left-color: #FFD700;
        }

        .writer-message {
            margin-right: 50px;
            border-left-color: #c47c15;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9em;
            color: #666;
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #FFD70033;
        }

        .message-content {
            white-space: pre-wrap;
            line-height: 1.5;
        }

        /* Message Actions */
        .message-actions {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            background: none;
            border: none;
            color: #c47c15;
            cursor: pointer;
            font-size: 0.85em;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background-color 0.2s, color 0.2s;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: #FFD052;
            color: #1C160C;
        }

        /* Edit Form */
        .edit-form {
            margin-top: 1rem;
        }

        .edit-form textarea {
            width: 100%;
            min-height: 100px;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #FCFAF5;
            color: #1C160C;
            font-size: 0.95rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .edit-form textarea:focus {
            outline: none;
            border-color: #FFD052;
            box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
        }

        .edit-form button {
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            background-color: #FFD052;
            color: #1C160C;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .edit-form button[type="button"] {
            background-color: #f5f5f5;
            color: #666;
        }

        .edit-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Reply Form */
        .reply-form {
            padding: 10px;
            border-top: 1px solid #eee;
            background: #fff;
        }

        .reply-form-container {
            display: flex;
            align-items: center;
        }

        .reply-textarea {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
            height: 36px;
            font-size: 14px;
        }

        .send-button {
            margin-left: 8px;
            background: #FFD052;
            color: #1C160C;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .send-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .message-container {
                flex-direction: column;
                width: 95%;
                margin: 1rem auto;
                height: auto;
            }

            .chat-list {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ccc;
            }

            .chat-area {
                width: 100%;
            }

            .chat-messages {
                height: auto;
                max-height: 600px;
            }

            .publisher-message,
            .writer-message {
                margin-left: 0;
                margin-right: 0;
            }

            .message-actions {
                flex-direction: column;
            }

            .send-button {
                width: 100%;
                margin-left: 0;
                margin-top: 8px;
            }
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/header-pub.php"; ?>

    <div class="message-container">


        <div class="chat-area">
            <div class="chat-header">Quotation Chat with <?= htmlspecialchars($writerName); ?></div>

            <div class="chat-messages">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $index => $message): ?>
                        <div
                            class="message <?= $message['sender_type'] == 'publisher' ? 'publisher-message' : 'writer-message'; ?>">
                            <div class="message-header">
                                <?= htmlspecialchars($message['sender_name']); ?> -
                                <?= htmlspecialchars($message['timestamp']); ?>

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
                                    <input type="hidden" name="quotation_id"
                                        value="<?= isset($quotationHistory) && isset($quotationHistory['quotaID']) ? htmlspecialchars($quotationHistory['quotaID']) : ''; ?>">
                                    <input type="hidden" name="message_index" value="<?= $index; ?>">
                                    <input type="hidden" name="writer_id" value="<?= htmlspecialchars($writerId); ?>">
                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookId); ?>">
                                    <textarea name="edited_message"><?= htmlspecialchars($message['content']); ?></textarea>
                                    <div>
                                        <button type="button" class="cancel-edit-btn"
                                            data-message-index="<?= $index; ?>">Cancel</button>
                                        <button type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No messages yet.</p>
                <?php endif; ?>
            </div>

            <div class="reply-form">
                <form action="/Free-Write/public/Publisher/sendQuotation2Wri" method="post" id="quotationReplyForm">
                    <input type="hidden" name="writer_id" value="<?= htmlspecialchars($writerId); ?>">
                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookId); ?>">
                    <div class="reply-form-container">
                        <textarea name="message" placeholder="Type your message here..." required
                            class="reply-textarea"></textarea>
                        <button type="submit" class="send-button">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Edit message functionality
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const messageIndex = this.getAttribute('data-message-index');
                document.getElementById(`message-content-${messageIndex}`).style.display = 'none';
                document.getElementById(`edit-form-${messageIndex}`).style.display = 'block';
            });
        });

        // Cancel edit
        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const messageIndex = this.getAttribute('data-message-index');
                document.getElementById(`message-content-${messageIndex}`).style.display = 'block';
                document.getElementById(`edit-form-${messageIndex}`).style.display = 'none';
            });
        });

        // Delete message confirmation
        function confirmDelete(index) {
            if (confirm('Are you sure you want to delete this message?')) {
                console.log("Deleting message at index: " + index);
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