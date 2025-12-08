import { atom } from 'jotai'

export const selectedDataAtom = atom<{
	postId: number,
	selectAllIcons: boolean,
	building?: string,
}>({
	postId: 0,
	selectAllIcons: true,
	building: undefined,
})