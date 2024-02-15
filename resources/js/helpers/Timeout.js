let timeoutController = null;

export async function TimeoutHelper(func, time = 1000) {
    clearTimeout(timeoutController);

    timeoutController = await setTimeout(async () => {
        await func();
        clearTimeout(timeoutController);
    }, time);

    return timeoutController
} 