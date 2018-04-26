require.config({
    baseUrl: '/js',
    paths: {
        jquery: "https://code.jquery.com/jquery-3.2.1.min",
        popper: "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min", // Does not work because bootstrap's scripts require 'popper.js' which loads a file. Looking forward to a fix of this.
        bootstrap: "https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min"
    }
})
