<div class="mt-2">
    <div class="d-flex flex-column justify-content-between align-items-center text-center" style="margin-top: 15vh;">
        <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-1">
            <path d="M50.3612 42.7678C50.2544 42.1777 49.9304 41.6489 49.4532 41.2857C48.976 40.9224 48.38 40.751 47.7828 40.8052C47.1855 40.8594 46.6301 41.1353 46.2261 41.5785C45.822 42.0217 45.5985 42.6001 45.5996 43.1998V64.8094L45.638 65.2414C45.7449 65.8316 46.0688 66.3603 46.546 66.7236C47.0232 67.0868 47.6192 67.2582 48.2165 67.204C48.8138 67.1498 49.3691 66.874 49.7732 66.4308C50.1772 65.9876 50.4007 65.4092 50.3996 64.8094V43.1998L50.3612 42.7678Z" fill="#747E9F"/>
            <path d="M51.8338 32.4003C51.8338 31.4455 51.4545 30.5298 50.7794 29.8547C50.1042 29.1796 49.1886 28.8003 48.2338 28.8003C47.279 28.8003 46.3633 29.1796 45.6882 29.8547C45.0131 30.5298 44.6338 31.4455 44.6338 32.4003C44.6338 33.3551 45.0131 34.2707 45.6882 34.9459C46.3633 35.621 47.279 36.0003 48.2338 36.0003C49.1886 36.0003 50.1042 35.621 50.7794 34.9459C51.4545 34.2707 51.8338 33.3551 51.8338 32.4003Z" fill="#747E9F"/>
            <path d="M86.3996 48.0001C86.3996 37.8158 82.3539 28.0486 75.1525 20.8472C67.9511 13.6458 58.1839 9.6001 47.9996 9.6001C37.8153 9.6001 28.0481 13.6458 20.8467 20.8472C13.6453 28.0486 9.59961 37.8158 9.59961 48.0001C9.59961 58.1844 13.6453 67.9516 20.8467 75.153C28.0481 82.3544 37.8153 86.4001 47.9996 86.4001C58.1839 86.4001 67.9511 82.3544 75.1525 75.153C82.3539 67.9516 86.3996 58.1844 86.3996 48.0001ZM14.3996 48.0001C14.3996 43.5877 15.2687 39.2185 16.9573 35.1419C18.6458 31.0654 21.1208 27.3614 24.2408 24.2413C27.3609 21.1213 31.0649 18.6463 35.1414 16.9577C39.218 15.2692 43.5872 14.4001 47.9996 14.4001C52.412 14.4001 56.7812 15.2692 60.8578 16.9577C64.9343 18.6463 68.6383 21.1213 71.7584 24.2413C74.8784 27.3614 77.3534 31.0654 79.042 35.1419C80.7305 39.2185 81.5996 43.5877 81.5996 48.0001C81.5996 56.9114 78.0596 65.4577 71.7584 71.7589C65.4572 78.0601 56.9109 81.6001 47.9996 81.6001C39.0883 81.6001 30.542 78.0601 24.2408 71.7589C17.9396 65.4577 14.3996 56.9114 14.3996 48.0001Z" fill="#747E9F"/>
        </svg>
        <p>Quae tibi placent quicunq prosunt aut diligebat multum, quod memor sis ad</p>
        <h3 class="mb-0">Are you sure?</h3>
        <form id="formDeleteAccount">
            @csrf
            <button type="submit" class="d-flex justify-content-center align-items-center btn btn-primary position-relative mt-1" style="font-size: 15px; height: 40px; width: 250px;">yes, delete my account</button>
        </form>
        
        <button type="button" class="d-flex justify-content-center align-items-center btn btn-secondary position-relative mt-1" id="btnNo" style="font-size: 15px; height: 40px; width: 250px;">no</button>
    </div>
</div>

<script>
    $('#formDeleteAccount').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: `/delete-account`,
            dataType: 'JSON',
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
            },
            success: (data) => {
                if (data.status === 200) {
                    toastr.warning('Your account has been successfully deactivate, you will be logged out!', 'Warning')
                    setTimeout(() => {
                        window.location = '/home'
                    }, 3500)
                }
            },
            error: (data) => {
                console.log(data)
                if (data.status === 400) {
                    toastr.warning(data.responseJSON.data, "Warning")
                    return 
                }

                if (data.status === 500) {
                    toastr.error("An internal server error occurred", "Error")
                    return
                }
            }
        })
    })

    $('#btnNo').on('click', function() {
        window.location = '/home'
    })
</script>