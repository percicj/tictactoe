function handleBoard(result) {
    const board = result.board;
    for(let y=0; y<board.length; y++) {
        let row = board[y];
        for (let x=0; x<row.length; x++) {
            $('#cell-' + x + '-' +y).html(row[x]);
        }
    }
    const win = result.win;
    if (win) {
        $('#winner').html(win);
        $('.cell').off('click');
    }
}

function bindClick() {
    $('.cell').click(function (e) {
        $.ajax({
            url: 'http://tictactoe.com/tictactoe/move',
            success: handleBoard,
            method: 'POST',
            data: {
                x: e.currentTarget.dataset.x,
                y: e.currentTarget.dataset.y,
                unit: 'X'
            }
        });
    });
}

$(document).ready(
    function () {
        $.ajax({
            url: 'http://tictactoe.com/tictactoe/load',
            success: handleBoard
        });

        bindClick();

        $('#restart').click(function () {
            $.ajax({
                url: 'http://tictactoe.com/tictactoe/restart',
                success: handleBoard,
            });
            bindClick();
        })
    }
);