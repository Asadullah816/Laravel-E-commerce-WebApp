@include('admin.adminMaster')
<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        @include('admin.adminSidebar')

        @include('admin.adminNav')
        <h1>Send Email to {{ $order->email }}</h1>
        <div class="container mt-5">
            <h2 class="mb-4">Send Email</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="recipient" class="form-label">Email Greeting</label>
                    <input type="email" class="form-control" id="recipient" name="greeting" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mail Url</label>
                    <textarea class="form-control" id="message" name="url" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Email</button>
            </form>
        </div>
        @include('admin.adminFooter')
    </div>
    @include('admin.adminScript')
