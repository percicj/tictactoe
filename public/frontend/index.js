function fillBoard(result) {
    const board = result.board;
    for(let y=0; y<board.length; y++) {
        let row = board[y];
        for (let x=0; x<row.length; x++) {
            $('#cell-' + x + '-' +y).html(row[x]);
        }
    }
}

$(document).ready(
    function () {
        $.ajax({
            url: 'http://tictactoe.com/tictactoe/load',
            success: fillBoard
        });

        $('.cell').click(function (e) {
            $.ajax({
                url: 'http://tictactoe.com/tictactoe/move',
                success: fillBoard,
                method: 'POST',
                data: {
                    x: e.currentTarget.dataset.x,
                    y: e.currentTarget.dataset.y,
                    unit: 'X'
                }
            });
        });

        $('#restart').click(function () {
            $.ajax({
                url: 'http://tictactoe.com/tictactoe/restart',
                success: fillBoard,
            });
        })
    }
);