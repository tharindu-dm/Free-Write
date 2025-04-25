<!-- Create Collection Form --------------------------------------- -->
<div class="create-collection-overlay">
    <div class="close-overlay-button">
        <button id="collection-cancelOverlayBtn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            close
        </button>
    </div>
    <div class="create-collection-container">
        <form id="collectionForm" action="/Free-Write/public/User/CreateCollection" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" maxlength="45"
                    placeholder="Enter a title for your collection">
                <span class="error-message" id="titleError"></span>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="Collect_description" name="Collect_description"
                    placeholder="Tell us about your collection..." maxlength="255"></textarea>
                <span class="error-message" id="descriptionError"></span>
            </div>

            <div class="form-group">
                <label for="visibility">Visibility</label>
                <select id="visibility" name="visibility">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
            </div>

            <button class="create-btn" type="submit">
                <span>Create Collection</span>
                <i class="arrow-icon"></i>
            </button>
        </form>
        <button class="discard-change-btn-collection" id="cancelOverlay">Discard Changes</button>
    </div>
</div>