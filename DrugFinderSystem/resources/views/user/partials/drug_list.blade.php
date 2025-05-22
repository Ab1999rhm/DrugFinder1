{{-- resources/views/user/partials/drug_list.blade.php --}}

<style>
    .drug-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 1.2rem;
        margin-top: 1.2rem;
        min-height: 420px;
    }

    .drug-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.08);
        padding: 1.2rem 1rem 1rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.2s, transform 0.12s;
        min-height: 240px;
        position: relative;
    }

    .drug-card:hover {
        box-shadow: 0 6px 24px rgba(37, 117, 252, 0.13);
        transform: translateY(-2px) scale(1.03);
    }

    .drug-meta {
        width: 100%;
        text-align: left;
        margin-bottom: 0.5rem;
        font-size: 0.97rem;
        color: #2575fc;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .drug-img {
        width: 54px;
        height: 54px;
        object-fit: contain;
        margin-bottom: 0.7rem;
        border-radius: 50%;
        background: #f7faff;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.03);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .drug-img img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        display: block;
        margin: auto;
    }

    .drug-title {
        font-size: 1.06rem;
        font-weight: 600;
        color: #2575fc;
        margin-bottom: 0.3rem;
        text-align: center;
    }

    .drug-desc {
        font-size: 0.95rem;
        color: #444;
        text-align: center;
        margin-bottom: 0.4rem;
    }

    .drug-actions {
        margin-top: auto;
        display: flex;
        gap: 0.3rem;
        justify-content: center;
        width: 100%;
    }

    .drug-actions .buy-btn {
        background: rgb(10, 140, 129);
        color: #fff !important;
        border: none;
        border-radius: 7px;
        margin-bottom: 15px;
        font-size: 0.93rem;
        cursor: pointer;
        transition: background 0.2s;
        font-weight: 600;
    }

    .wishlist-success-message {
        font-size: 0.95rem;
        color: green;
        font-weight: 600;
        margin-top: 0.4rem;
    }


    .drug-actions button,
    .drug-actions a,
    .drug-actions form button {
        background: #2575fc;
        color: #fff !important;
        border: none;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 0.93rem;
        cursor: pointer;
        transition: background 0.2s;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .drug-actions button:hover,
    .drug-actions a:hover,
    .drug-actions form button:hover {
        background: #6a11cb;
        color: #fff !important;
    }

    .drug-actions .btn-warning {
        background: #ffc107 !important;
        color: #333 !important;
        border: none;
        margin-bottom: 15px;
    }

    .drug-actions .btn-warning:hover {
        background: #ff9800 !important;
        color: #fff !important;
    }

    .pagination {
        justify-content: center;
        margin-top: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .pagination .page-link {
        padding: 0.2rem 0.5rem;
        font-size: 0.85rem;
        min-width: 22px;
        height: 26px;
        border-radius: 0.25rem;
    }

    .pagination .page-link[aria-label="Previous"],
    .pagination .page-link[aria-label="Next"] {
        font-size: 1rem;
        padding: 0.12rem 0.35rem;
    }

    .pagination .page-link:hover {
        background: #2575fc;
        color: #fff;
    }

    @media (max-width: 991px) {
        .drug-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
        }
    }

    @media (max-width: 600px) {
        .drug-grid {
            grid-template-columns: 1fr;
            grid-template-rows: none;
        }
    }
</style>

@if($drugs->count())
<div class="drug-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.4rem; margin-top: 1.2rem;">
    @foreach($drugs as $drug)
    <div class="drug-card">
        <div class="drug-meta">
            <div>
                Price: <span style="color:#6a11cb;">{{ number_format($drug->price, 2) }} ETB</span>
            </div>
            <div>
                Place:
                <span style="color:#40916c;">
                    {{ optional($drug->seller)->country ?? '-' }},
                    {{ optional($drug->seller)->state ?? '-' }},
                    {{ optional($drug->seller)->city ?? '-' }}.
                    <p>Tel:{{ optional($drug->seller)->emergency_contact ?? '-' }}</p>



                    <h6>Tel:{{ optional($drug->seller)->emergency_contact ?? '-' }}</h6>
                </span>
            </div>
        </div>
        <div class="drug-img" style="width: 60px; height: 60px; margin-bottom: 0.7rem;">
            <img src="/images/madanit.jpg" alt="Drug Symbol" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="drug-title">
            {{ $drug->name }}
        </div>
        <div class="drug-desc">
            {{ Str::limit($drug->description, 60) }}
        </div>
        <div class="drug-actions">
            <button class="buy-btn" onclick="window.location.href='/user/drugs/{{ $drug->id }}/compare'">
                <i class="fas fa-shopping-cart"></i> Buy
            </button>
            <button class="details-btn btn-warning" data-id="{{ $drug->id }} ">
                <i class="fas fa-info-circle"></i> Details
            </button>

            {{-- Wishlist Add Form --}}
            <form method="POST" action="{{ route('user.wishlist.store') }}" class="wishlist-form d-inline" autocomplete="off">
                @csrf
                <input type="hidden" name="drug_id" value="{{ $drug->id }}">
                <button type="submit" class="wishlist-btn" title="Add to Wishlist" style="background: green; color: #fff; border: none; font-weight: 600; display: flex; align-items: center; gap: 4px; cursor: pointer; padding: 11px 8px; border-radius: 7px;">
                    <i class="fas fa-heart"></i> Add to Wishlist
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $drugs->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
</div>
@else
<div class="text-center text-muted py-4" style="font-size: 1.1rem;">
    <i class="fas fa-search fa-2x mb-2"></i>
    <div>No drugs found matching your search.</div>
</div>
@endif

<script>
    $(document).off('submit', '.wishlist-form').on('submit', '.wishlist-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find('.wishlist-btn');
        let parent = form.parent(); // container div for the card-actions
        btn.prop('disabled', true);
        let originalHtml = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i> Adding...');

        // Remove any existing message first
        parent.find('.wishlist-success-message').remove();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    btn.html('<i class="fas fa-check"></i> Added!');
                    // Show message below buttons
                    let message = $('<div class="wishlist-success-message" style="color: green; font-weight: 600; margin-top: 0.4rem;">You have added it.</div>');
                    parent.append(message);
                    setTimeout(() => {
                        btn.html(originalHtml);
                        btn.prop('disabled', false);
                        message.fadeOut(500, function() {
                            $(this).remove();
                        });
                    }, 2500);
                } else {
                    alert(response.message || 'Could not add to wishlist.');
                    btn.html(originalHtml);
                    btn.prop('disabled', false);
                }
            },
            error: function() {
                alert('Something went wrong. Please try again.');
                btn.html(originalHtml);
                btn.prop('disabled', false);
            }
        });
    });
</script>