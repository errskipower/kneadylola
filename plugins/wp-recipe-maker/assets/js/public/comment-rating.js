window.WPRecipeMaker.rating = {
	init: () => {
		const ratingFormElem = document.querySelector( '.comment-form-wprm-rating' );

		if ( ratingFormElem ) {
			const recipes = document.querySelectorAll( '.wprm-recipe-container' );
			const admin = document.querySelector( 'body.wp-admin' );

			if ( recipes.length > 0 || admin ) {
				ratingFormElem.style.display = '';
			} else {
				// Hide when no recipe is found.
				ratingFormElem.style.display = 'none';
			}
		}
	},
	settings: {
		enabled: typeof window.wprm_public !== 'undefined' ? wprm_public.settings.features_comment_ratings : wprm_admin.settings.features_comment_ratings,
		color: typeof window.wprm_public !== 'undefined' ? wprm_public.settings.template_color_comment_rating : 'black',
	},
	onMouseEnter: ( el ) => {
		const rating = parseInt( el.dataset.rating );
		const stars = WPRecipeMaker.rating.getStars( el );

		if ( stars ) {
			stars.map( ( star, index ) => {
				const iconParts = [ ...star.querySelectorAll( 'polygon' ) ];

				if ( index < rating ) {
					star.classList.add( 'wprm-rating-star-selecting-filled' );
					iconParts.map( ( iconPart ) => { iconPart.style.fill = WPRecipeMaker.rating.settings.color } );
				} else {
					star.classList.add( 'wprm-rating-star-selecting-empty' );
					iconParts.map( ( iconPart ) => { iconPart.style.fill = 'none' } );
				}
			} );
		}
	},
	onMouseLeave: ( el ) => {
		const stars = WPRecipeMaker.rating.getStars( el );

		if ( stars ) {
			stars.map( ( star ) => {
				const iconParts = [ ...star.querySelectorAll( 'polygon' ) ];

				star.classList.remove( 'wprm-rating-star-selecting-filled' );
				star.classList.remove( 'wprm-rating-star-selecting-empty' );
				iconParts.map( ( iconPart ) => { iconPart.style.fill = '' } );
			} );
		}
	},
	onClick: ( el ) => {
		const stars = WPRecipeMaker.rating.getStars( el );
		const input = WPRecipeMaker.rating.getInput( el );

		let newRating = parseInt( el.dataset.rating );
		const oldRating = parseInt( input.value );

		if ( newRating === oldRating ) {
			input.value = '';
			newRating = 0;
		} else {
			input.value = newRating;
		}

		if ( stars ) {
			stars.map( ( star, index ) => {
				if ( index < newRating ) {
					star.classList.add( 'rated' );
				} else {
					star.classList.remove( 'rated' );
				}
			} );
		}
	},
	getStars: ( el ) => {
		let stars = [];

		Array.prototype.filter.call( el.parentNode.children, ( child ) => {
			if ( child.classList.contains( 'wprm-rating-star' ) ) {
				const rating = parseInt( child.dataset.rating ) - 1;
				stars[ rating ] = child;
			}
		});

		if ( 5 === stars.length ) {
			return stars;
		} else {
			return false;
		}
	},
	getInput: ( el ) => {
		const container = el.closest( '.comment-form-wprm-rating' );
		return container.querySelector( '#wprm-comment-rating' );
	},
};

ready(() => {
	window.WPRecipeMaker.rating.init();
});

function ready( fn ) {
    if (document.readyState != 'loading'){
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}