let activeUser;
let usersSet;

export const renderResults = function (users, actUser, page = 1, resPerPage = 10) {
  // render results of current page
  activeUser = actUser;
  usersSet = users;
  const start = (page - 1) * resPerPage;
  const end = page * resPerPage;

  users.slice(start, end).forEach(renderUser);

  document
      .querySelector(".search__results-container")
      .insertAdjacentHTML("beforeend", `<div class="btn__container"></div>`);
  // render pagination buttons
  renderButtons(page, users.length, resPerPage);

};

const renderUser = function(user) {
    let markup = `
    <form class='search__result-card' id='form-card' method='get'>
        <div class='search__result-user-mainbox search__result-mainbox'>
            <div class='user-mainbox__img-box'>
                <img src='/utrance-railway/public/img/uploads/${
                  user.user_image
                }.jpg' alt='profile-avatar' class='profile__avatar'/>
            </div>
            <div class='user-mainbox__other'>
                <div class ='user-mainbox__other-name'>${user.first_name}</div>
                <div class ='user-mainbox__other-id'>
                    <span>#</span>
                    <span class='user__id'>${user.id}</span>
                </div>
            </div>
        </div>
        <div class='search__result-user-emailbox'>
            ${user.user_active_status ? "Active" : "Deactivated"}
        </div>
        <div class='search__result-user-rolebox'>
            ${
              user.user_role === "admin"
                ? "Admin"
                : user.user_role === "user"
                ? "User"
                : "Details Provider"
            }
        </div>`;

    if(user.user_role === 'admin' && user.first_name === activeUser.first_name) {
        markup += `<a href='/utrance-railway/settings' class='btn btn-box-white margin-r-s'>View</a>`;
    } else {
        markup += `<a href='/utrance-railway/users/view?id=${user.id}' class='btn btn-box-white margin-r-s'>View</a>`;
    }

    if(user.user_active_status) {
        if(user.user_role !== 'admin') {
            markup += `<a href='/utrance-railway/users/deactivate?id=${user.id}&user_active_status=${user.user_active_status}' class='btn btn-box-white btn-box-white--delete'>Deactivate</a>`;
        } else {
            markup += `<a style='visibility: hidden'></a>`;
        }
    } else {
        if(user.user_role !== 'admin') {
            markup += `<a href='/utrance-railway/users/activate?id=${user.id}&user_active_status=${user.user_active_status}' class='btn btn-box-white btn-box-white--activate'>Activate</a>`;
        } else {
            markup += `<a style='visibility: hidden'></a>`;
        }
    }

    markup += `</form>`;

    // console.log(markup); 
    document
      .querySelector(".search__results-container")
      .insertAdjacentHTML("beforeend", markup);
    
}

// type: 'prev' or 'next'
const createButton =  function(page, type) {
    return `
    <button class='btn btn-round-pagination btn-round-pagination__${type} margin-b-l' data-goto=${
      type === "prev" ? page - 1 : page + 1
    }>
        <svg class='btn-round-pagination--img'>
            <use xlink:href='/utrance-railway/public/img/svg/sprite.svg#icon-chevron-${
              type === "prev" ? "left" : "right"
            }'></use>
        </svg>
        <span>Page ${type === "prev" ? page - 1 : page + 1}</span>
    </button>
    `;
}

const renderButtons = function(page, numResults, resPerPage) {
    const pages = Math.ceil(numResults / resPerPage);

    let button;
    if(page === 1 && pages > 1) {
        // button to go next page
       button = createButton(page, 'next');
    } else if(page < pages) {
        // both buttons
        button = `
            ${createButton(page, 'prev')}
            ${createButton(page, 'next')}
        `;
    } else if(page === pages && pages > 1) {
        // button to go previous page
        button = createButton(page, 'prev');
    }

    document
      .querySelector(".btn__container")
      .insertAdjacentHTML("afterbegin", button);

}

