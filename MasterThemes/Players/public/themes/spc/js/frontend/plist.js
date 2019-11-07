// Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.
(function updatePlayerStatus() {
    var Status = {
        0: 'Offline',
        1: 'Online',
        2: 'Starting',
        3: 'Stopping'
    };
    $('.ply-update').each(function (index, data) {
        var element = $(this);
        var serverShortUUID = $(this).data('server');

        $.ajax({
            type: 'GET',
            url: Router.route('index.status', { server: serverShortUUID }),
            timeout: 5000,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            }
        }).done(function (data) {
            if (typeof data.status === 'undefined') {
                    element.find('[data-action="players"]').html('--');
                    element.find('[data-action="maxplayers"]').html('--');
                return;
            }
            switch (data.status) {
                case 0:
                    element.find('[data-action="players"]').html('--');
                    element.find('[data-action="maxplayers"]').html('--');
                    break;
            }

            if (data.status > 0 && data.status < 4) {
                var players = data.proc.players;
                var maxplayers = data.proc.maxplayers;

                if (data.status !== 0) {
                    element.find('[data-action="players"]').html(players);
                    element.find('[data-action="maxplayers"]').html(maxplayers);
                } else {
                    element.find('[data-action="players"]').html('--');
                    element.find('[data-action="maxplayers"]').html('--');
                }

            }
        }).fail(function (jqXHR) {

        });
    }).promise().done(function () {
        setTimeout(updatePlayerStatus, 10000);
    });
})();
