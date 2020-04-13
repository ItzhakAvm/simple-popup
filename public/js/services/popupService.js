/**
 * Gets the popup content.
 *
 * @returns {Promise<any>}
 */
export const getContent = () => {
    return fetch('/popup/getContent')
        .then((response) => {
            return response.json();
        });
};