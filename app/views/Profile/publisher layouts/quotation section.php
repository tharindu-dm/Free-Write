<!-- My Quotation chat -->
<div id="quotations" class="view-section">
    <h2>My Quotation chat </h2>
    <style>
        .quotation-container {
            display: flex;
            max-width: 1600px;
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            font-family: Arial, sans-serif;
            height: 1000px;
        }

        .chat-list {
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
        }

        .chat-user {
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

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
        }

        .chat-messages {
            padding: 15px;
            height: 1000px;
            overflow-y: auto;
            background: #f9f9f9;
        }

        .empty-message {
            text-align: center;
            color: #888;
        }

        .reply-form {
            padding: 10px;
            border-top: 1px solid #eee;
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

        .no-quotations {
            text-align: center;
            padding: 30px;
            background: #f9f9f9;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>

    <?php if (!empty($quotationData)): ?>
        <div class="quotation-container">

            <div class="chat-list">
                <div class="chat-list-header">Writers</div>

                <?php foreach ($quotationData as $index => $quotation): ?>
                    <div onclick="showChat(<?= $index ?>)" class="chat-user">
                        <?php if ($userType == 'pub'): ?>
                            <?= htmlspecialchars($quotation['writerName']) ?>
                        <?php endif; ?>
                        <?php if ($userType == 'writer'): ?>
                            <?= htmlspecialchars($quotation['publisherName']) ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Chat area -->
            <div class="chat-area">
                <div class="chat-header" id="chatTitle">
                    Select a writer
                </div>

                <div class="chat-messages" id="chatMessages">
                    <!-- Messages will be inserted here -->
                    <p class="empty-message">Select a conversation to view messages</p>
                </div>

                <!-- Reply form -->
                <div class="reply-form" id="replyForm" style="display: none;">
                    <form action="/Free-Write/public/Publisher/sendQuotationChat" method="post" id="quotationReplyForm">
                        <input type="hidden" name="writer_id" id="replyWriterId" value="">
                        <input type="hidden" name="book_id" id="replyBookId" value="">
                        <input type="hidden" name="publisher_id" id="replyPublisherId" value="">
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
            // Store all quotation data from PHP
            const quotationData = <?= json_encode($quotationData) ?>;

            function showChat(index) {
                if (!quotationData[index]) return;

                const messagesContainer = document.getElementById("chatMessages");
                const chatTitle = document.getElementById("chatTitle");
                const replyForm = document.getElementById("replyForm");
                const replyWriterId = document.getElementById("replyWriterId");
                const replyBookId = document.getElementById("replyBookId");
                const replyPublisherId = document.getElementById("replyPublisherId");
                messagesContainer.innerHTML = "";
                chatTitle.innerText = quotationData[index].writerName;

                // Update reply form with current writer and book IDs
                replyWriterId.value = quotationData[index].writerId;
                replyBookId.value = quotationData[index].bookId;
                replyPublisherId.value = quotationData[index].publisherId;
                replyForm.style.display = "block";

                // Display messages
                if (quotationData[index].messages && quotationData[index].messages.length > 0) {
                    quotationData[index].messages.forEach(msg => {
                        const div = document.createElement("div");
                        div.style.marginBottom = "10px";
                        const headerDiv = document.createElement("div");
                        headerDiv.style.fontSize = "0.8em";
                        headerDiv.style.color = "#666";
                        headerDiv.style.marginBottom = "5px";
                        headerDiv.textContent = msg.sender_name + " - " + msg.timestamp;
                        div.appendChild(headerDiv);

                        const contentDiv = document.createElement("div");
                        contentDiv.style.padding = "10px";
                        contentDiv.style.borderRadius = "10px";
                        contentDiv.style.maxWidth = "75%";
                        contentDiv.style.background = msg.sender_type === "publisher" ? "#e1ffc7" : "#c7dfff";
                        contentDiv.textContent = msg.text;
                        div.appendChild(contentDiv);

                        // Align writer messages to the right
                        if (msg.sender_type === "publisher") {
                            div.style.marginLeft = "auto";
                        }
                        if (msg.sender_type === "writer") div.style.marginRight = "auto";
                        messagesContainer.appendChild(div);
                    });

                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                } else {
                    messagesContainer.innerHTML = "<p class='empty-message'>No messages yet</p>";
                }
            }

            // Load first writer by default if available
            if (quotationData.length > 0) {
                showChat(0);
            }
        </script>

    <?php else: ?>
        <div class="no-quotations">
            <p>You don't have any quotation conversations yet.</p>
        </div>
    <?php endif; ?>
</div>

<div id="courierOrders" class="view-section">
    <h2>My Orders are here</h2>
</div>