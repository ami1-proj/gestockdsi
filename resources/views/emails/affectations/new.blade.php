@extends('emails.layouts.master')

@section('content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content --><tr>
                    <td class="content-cell">
                        <h1>Heading 1</h1>
                        <p>This is a paragraph filled with Lorem Ipsum and a link. Cumque dicta <a href="">doloremque eaque</a>, enim error laboriosam pariatur possimus tenetur veritatis voluptas.</p>
                        <h2>Heading 2</h2>
                        <div class="table">
                            <table>
                                <thead><tr>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr></thead>
                                <tbody>
                                <tr>
                                    <td>Product 1</td>
                                    <td>Lorem Ipsum</td>
                                    <td>$10</td>
                                </tr>
                                <tr>
                                    <td>Product 2</td>
                                    <td>Lorem ipsum dolor sit amet.</td>
                                    <td>$20</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <h3>Heading 3</h3>
                        <p >This is a paragraph filled with Lorem Ipsum and a link. Cumque dicta <a href="">doloremque eaque</a>, enim error laboriosam pariatur possimus tenetur veritatis voluptas.</p>
                        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td align="center">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
                                            <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0"><tr>
                                                        <td>
                                                            <a href="#" class="button button-blue" target="_blank">Blue button</a>
                                                        </td>
                                                    </tr></table>
                                            </td>
                                        </tr></table>
                                </td>
                            </tr></table>
                        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td align="center">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
                                            <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0"><tr>
                                                        <td>
                                                            <a href="#" class="button button-green" target="_blank">Green button</a>
                                                        </td>
                                                    </tr></table>
                                            </td>
                                        </tr></table>
                                </td>
                            </tr></table>
                        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td align="center">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
                                            <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0"><tr>
                                                        <td>
                                                            <a href="#" class="button button-red" target="_blank">Red button</a>
                                                        </td>
                                                    </tr></table>
                                            </td>
                                        </tr></table>
                                </td>
                            </tr></table>
                        <table class="panel" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td class="panel-content">
                                    <table width="100%" cellpadding="0" cellspacing="0"><tr>
                                            <td class="panel-item">
                                                <p>How awesome is this panel?</p>
                                            </td>
                                        </tr></table>
                                </td>
                            </tr></table>
                        <p >Heading 3</p>
                        <table class="promotion" align="center" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td align="center">
                                    <p>Coupon code: MarkdownMail</p>
                                </td>
                            </tr></table>
                        <p >Thanks,<br>
                            MarkdownMail</p>
                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"><tr>
                                <td>
                                    <p>This is the subcopy of the email</p>
                                </td>
                            </tr></table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection
